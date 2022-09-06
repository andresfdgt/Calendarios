<?php

namespace App\Services;

class RecetaService
{

  private $DB;
  private $type_alergenos = ['altramuces', 'apio', 'cacahuetes', 'crustaceos', 'frutos_secos', 'gluten', 'huevos', 'leche', 'moluscos', 'mostaza', 'pescado', 'sesamo', 'soya', 'sulfitos'];
  private $version_id;
  private $suma_peso;

  function __construct($DB, $version_id)
  {
    $this->DB = $DB;
    $this->version_id = $version_id;
    $this->suma_peso =  $this->sumCount();
  }

  public static function init($DB, $version_id)
  {
    return new RecetaService($DB, $version_id);
  }

  public function dataInformacion($peso = null, $equilibrados = 1, $nutricional = 1, $alergenos = 1)
  {
    $deseado = $this->pesoDeseado($peso);

    $data['deseado'] =  $deseado;
    $data['datos'] = ($equilibrados) ? $this->datosDetalle($deseado, $peso) : [];
    $data['alergenos'] = ($alergenos) ? $this->alergenos() : [];

    $indicativos['viscosidad'] = $this->viscosidad();
    $indicativos['poder_anticongelante'] = $this->poderAnticongelante();
    $indicativos['dulzor_relativo'] = $this->dulzorRelativo();
    $indicativos['lactosa_absoluta'] = $this->lactosaAbsoluta();
    $indicativos['pac_pm'] = $this->pacPm();
    $data["indicativos"] =  $indicativos;

    $data['informacion_nutricional'] = ($nutricional) ? $this->informacionNutricional() : [];

    return $data;
  }

  private function pesoDeseado($peso = null)
  {
    if ($peso) return $peso;

    return $this->DB->select("SELECT peso_deseado FROM equ_recetas_versiones WHERE id =$this->version_id")[0]->peso_deseado;
  }

  private function sumCount()
  {
    $data_filas = $this->DB->select("SELECT ifnull(SUM(peso),0) as suma FROM equ_recetas_versiones_ingredientes WHERE receta_version_id = $this->version_id")[0];
    return  $data_filas->suma;
  }

  private function datosDetalle($deseado, $peso_externo = null)
  {
    $datos = $this->DB->table("equ_recetas_versiones_ingredientes as vi")
      ->join("equ_ingredientes as i", "vi.ingrediente_id", "i.id")
      ->join("equ_ingredientes_atributos as ia", "ia.ingrediente_id", "i.id")
      ->where("receta_version_id", $this->version_id)
      ->select("vi.id", "i.nombre", "vi.peso", "vi.topping", "i.precio_base", "ia.azucares", "ia.materia_grasa_lactea", "ia.materia_grasa_no_lactea", "ia.solidos_no_grasos_de_la_leche", "ia.otros_solidos", "ia.parte_seca", "ia.proteinas_lacteas", "ia.lactosa", "ia.energia_kcal", "ia.peso_molecular_azucares", "ia.alcohol")
      ->get()
      ->toArray();

    foreach ($datos as $key => $dato) {
      $dato = (array) $dato;
      $testigo = $this->suma_peso;
      $porcentaje = $dato["peso"] / $this->suma_peso;
      #SI EL PESO DESEADO VIENE DESDE EL IMPRIMIR SE USA ESA VALIDACION PARA ASIGNAR DICHO VALOR
      if ($peso_externo != null) {
        $this->suma_peso = ($deseado == 0)?1:$deseado;
        $dato["peso"] = doubleval($deseado) * $porcentaje;
      }
      $datos[$key] = [
        "id" => $dato["id"],
        "nombre" => $dato["nombre"],
        "topping" => $dato["topping"],
        "peso" => $dato["peso"],
        "precio_base" => $dato["precio_base"],
        "porcentaje" => $this->redondear($porcentaje * 100),
        "deseado" => $deseado != 0 ? $this->redondear(($dato["peso"] /  $deseado) * 100) : 0,
        "azucares" => $this->redondear(($dato["azucares"] * $porcentaje)),
        "materia_grasa_lactea" => $this->redondear(($dato["materia_grasa_lactea"] * $porcentaje)),
        "materia_grasa_no_lactea" => $this->redondear(($dato["materia_grasa_no_lactea"] * $porcentaje)),
        "slng" => $this->slngsDetalle($dato["peso"], $dato["solidos_no_grasos_de_la_leche"]),
        "proteinas_lacteas" => $this->redondear(($dato["proteinas_lacteas"] * $porcentaje)),
        "lactosa" => $this->redondear(($dato["lactosa"] * $porcentaje)),
        "otros_solidos" => $this->otrosSolidosDetalle($dato["peso"], $dato["otros_solidos"]),
        "energia_kcal" => $this->redondear(($dato["energia_kcal"] * $porcentaje)),
        "solidos_totales" => $this->solidosTotalesDetalle($dato["peso"], $dato["parte_seca"]),
        "visco" => $this->viscosidadDetalle($dato["peso"], $dato["azucares"], $dato["lactosa"]),
        "pacpm" => $this->pacpmDetalle($dato["peso"], $dato["peso_molecular_azucares"], $dato["azucares"], $dato["alcohol"], $dato["lactosa"])
      ];
      $this->suma_peso = $testigo;
    }
    return $datos;
  }
  private function redondear($dato)
  {
    return round($dato, 2);
  }

  private function otrosSolidosDetalle($peso, $otros_solidos)
  {
    $otros_solidos = (($peso * 100) / $this->suma_peso) * ($otros_solidos / 100);
    return $this->redondear($otros_solidos);
  }

  private function solidosTotalesDetalle($peso, $total_solidos)
  {
    $total_solidos = (($peso * 100) / $this->suma_peso) * ($total_solidos / 100);
    return $this->redondear($total_solidos);
  }

  private function slngsDetalle($peso, $solidos_no_grasos_de_la_leche)
  {
    $solidos_no_grasos_de_la_leche = (($peso * 100) / $this->suma_peso) * ($solidos_no_grasos_de_la_leche / 100);
    return $this->redondear($solidos_no_grasos_de_la_leche);
  }
  private function viscosidadDetalle($peso, $azucares, $lactosa)
  {
    $visco = ($peso / $this->suma_peso) * (($azucares + $lactosa) * 342);
    return $this->redondear($visco);
  }

  private function pacpmDetalle($peso, $peso_molecular_azucares, $azucares, $alcohol, $lactosa)
  {
    $pac_pm = 0;
    if ($peso_molecular_azucares != 0) {
      if ($alcohol > 0) {
        $pac_pm = (($peso * 100) / $this->suma_peso) * 342 * (($azucares + $lactosa) / $peso_molecular_azucares / 10) + (($peso * 100) / $this->suma_peso * 9 * $alcohol / 10);
      } else if ($alcohol == 0) {
        $pac_pm = (($peso * 100) / $this->suma_peso) * 342 * ($azucares + $lactosa) / $peso_molecular_azucares / 10;
      }
    }

    return $this->redondear($pac_pm);
  }
  //Esta bien 
  private function viscosidad()
  {
    $viscosidad = $this->DB->select("SELECT (sum((rvi.peso/$this->suma_peso) * (ia.azucares+ia.lactosa) * ia.peso_molecular_azucares) /  (sum(((rvi.peso*100)/$this->suma_peso) * ia.azucares/100) + sum((rvi.peso*100/$this->suma_peso) * ia.lactosa/100))) as viscosidad FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND (ia.AZUCARES!=0 OR ia.LACTOSA!=0) AND rvi.peso!=0 AND rvi.topping = 0 AND rvi.receta_version_id= $this->version_id")[0]->viscosidad ?? 0;
    return $this->redondear($viscosidad);
  }
  //Esta bien 
  private function poderAnticongelante()
  {
    $poder_anticongelante = $this->DB->select("SELECT (((SUM(((rvi.peso*100)/$this->suma_peso)*(ia.azucares+ia.lactosa)*ia.poder_anticongelante/100)* (100-SUM(((rvi.peso*100)/$this->suma_peso)*(ia.parte_seca)/100))/100)+ (SUM(((rvi.peso*100)/$this->suma_peso)*COALESCE(ia.alcohol,0)*10*ia.poder_anticongelante/100)*(100-SUM(((rvi.peso*100)/$this->suma_peso)*(ia.parte_seca)/100))/100))) as poder_anticongelante FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND rvi.peso!=0 AND rvi.topping = 0 AND rvi.receta_version_id= $this->version_id")[0]->poder_anticongelante ?? 0;
    return $this->redondear($poder_anticongelante);
  }
  //Esta bien
  private function dulzorRelativo()
  {
    $dulzor_relativo = $this->DB->select("SELECT  (SUM(((rvi.peso*100)/$this->suma_peso)*(ia.AZUCARES*ia.dulzor_relativo+ia.lactosa*15)/10000)) as dulzor_relativo FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND rvi.peso!=0 AND rvi.topping = 0 AND rvi.receta_version_id= $this->version_id")[0]->dulzor_relativo ?? 0;
    return $this->redondear($dulzor_relativo);
  }

  private function lactosaAbsoluta()
  {

    $lactosa_absoluta = $this->DB->select("SELECT  (SUM(((rvi.peso*100)/$this->suma_peso)*ia.lactosa/100)) as valor_1,SUM(((rvi.peso*100)/$this->suma_peso)*(ia.parte_seca)/100) as valor_2 FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND rvi.peso!=0 AND rvi.topping = 0 AND rvi.receta_version_id= $this->version_id")[0];

    if ($lactosa_absoluta->valor_2 == 100) $lactosa_absoluta->valor_2 = 99.9;

    $lactosa_absoluta =  ($lactosa_absoluta->valor_1 * 100) / (100 -  $lactosa_absoluta->valor_2);
    return $this->redondear($lactosa_absoluta);
  }

  //Cristian esta función que significa
  private function pacPm()
  {
    $pac_pm = $this->DB->select("SELECT (SUM(((rvi.peso*100)/$this->suma_peso)*342*(ia.azucares+ia.lactosa)/ia.peso_molecular_azucares/10)+ SUM(((rvi.peso*100)/$this->suma_peso)*9*ia.alcohol/10)) as pac_pm FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND rvi.peso!=0 AND rvi.topping = 0 AND rvi.receta_version_id=$this->version_id")[0]->pac_pm ?? 0;
    $valor_2 = 0;
    $limite_inf = 0;
    if ($pac_pm >= 241 && $pac_pm <= 260) {
      $valor_2 = -10;
      $limite_inf = 241;
    } else if ($pac_pm >= 261 && $pac_pm <= 280) {
      $valor_2 = -11;
      $limite_inf = 261;
    } else if ($pac_pm >= 281 && $pac_pm <= 300) {
      $valor_2 = -12;
      $limite_inf = 281;
    } else if ($pac_pm >= 301 && $pac_pm <= 320) {
      $valor_2 = -13;
      $limite_inf = 301;
    } else if ($pac_pm >= 321 && $pac_pm <= 340) {
      $valor_2 = -14;
      $limite_inf = 321;
    } else if ($pac_pm >= 341 && $pac_pm <= 360) {
      $valor_2 = -15;
      $limite_inf = 341;
    } else if ($pac_pm >= 361 && $pac_pm <= 380) {
      $valor_2 = -16;
      $limite_inf = 361;
    } else if ($pac_pm >= 381 && $pac_pm <= 400) {
      $valor_2 = -17;
      $limite_inf = 381;
    } else if ($pac_pm >= 401 && $pac_pm <= 420) {
      $valor_2 = -18;
      $limite_inf = 401;
    } else if ($pac_pm >= 421) {
      $valor_2 = -19;
      $limite_inf = 421;
    }

    if ($pac_pm < 241) {
      $pac_pm = -10;
    } else {
      $pac_pm = $valor_2 - (($pac_pm - $limite_inf) / 20);
    }

    return $this->redondear($pac_pm);
  }

  private function informacionNutricional()
  {
    return $this->DB->select("SELECT round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.energia_kcal/100),2) as kcal,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.energia_kj/100),2) as kj,round(SUM(((rvi.peso*100)/$this->suma_peso)*(ia.grasas)/100),2) as gt,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.grasa_saturadas/100),2) as gs,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.hidratos_de_carbono/100),2) as hc,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.azucares/100),2) as az,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.fibras/100),2) as fibra,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.proteinas/100),2) as prot,round(SUM(((rvi.peso*100)/$this->suma_peso)*ia.sales/100),2) as sales FROM equ_recetas_versiones_ingredientes as rvi,equ_ingredientes_atributos as ia WHERE rvi.ingrediente_id = ia.ingrediente_id AND rvi.peso!=0 AND rvi.receta_version_id=$this->version_id")[0];
  }

  private function alergenos()
  {
    $datas = $this->DB->SELECT("SELECT i.ingrediente_id, i.altramuces,i.apio,i.cacahuetes,i.crustaceos,i.frutos_secos,i.gluten,i.huevos,i.leche,i.moluscos,i.mostaza,i.pescado,i.sesamo,i.soya,i.sulfitos FROM equ_recetas_versiones_ingredientes as vi, equ_ingredientes_atributos as i WHERE vi.ingrediente_id = i.ingrediente_id AND receta_version_id = $this->version_id");
    $alergenos = [];
    foreach ($datas as $data) {
      foreach ($this->type_alergenos as $type_alergeno) {
        if ($data->$type_alergeno) {
          if (!in_array($type_alergeno, $alergenos)) {
            $alergenos[] = ucfirst(str_replace('_', ' ', $type_alergeno));
          }
        }
      }
    }

    return  $alergenos;
  }
}
