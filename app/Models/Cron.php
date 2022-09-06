<?php

namespace App\Models;

use App\Helpers\CustomResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class Cron extends Model
{
  public static function entradas()
  {
    /*
    $entradas_disponible = DB::table("db_empresa1_1.cron")
      ->select("entradas")
      ->first()->entradas;

    if ($entradas_disponible) return;
    */

    DB::table("db_empresa1_1.cron")
      ->update(["entradas" => 1]);

    $entradas = DB::table("db_empresa1_1.cal_albaranes")
      ->whereNull("deleted_at")
      ->where("clasificacion", 1)
      ->whereDate("created_at", Carbon::now()->format("Y-m-d"))
      ->select("id", "tipo", "numero")
      ->get();

    foreach ($entradas as $entrada) {
      $url = env("URL_API_CALENDARIO") . "entradas/$entrada->tipo/$entrada->numero";
      $peticion = Http::get($url);

      if ($peticion->failed()) {
        continue;
      }
      $peticion = $peticion->object();

      DB::beginTransaction();

      try {

        if (!empty($peticion->cdbCitaPrevia)) {

          $evento_id = DB::table("db_empresa1_1.cal_albaranes")->where("id", $entrada->id)->select("evento_id")->first()->evento_id;
          // $albaran = DB::table("db_empresa1_1.cal_eventos")->where("id", $evento_id)->select("fecha_inicio", "fecha_fin")->first();

          $fecha_inicio = (new Carbon($peticion->cdbCitaPrevia))->format("y-m-d H:i:s");
          $fecha_fin = (new Carbon($peticion->cdbCitaPrevia))->modify("+1 hours")->format("y-m-d H:i:s");
          DB::table("db_empresa1_1.cal_eventos")->where("id", $evento_id)
            ->update([
              "fecha_inicio" => $fecha_inicio,
              "fecha_fin" => $fecha_fin,
              "updated_at" => Carbon::now()
            ]);
        }
        DB::table("db_empresa1_1.cal_albaranes")->where("id", $entrada->id)
          ->update([
            "fecha_ent_real" => $peticion->cdbFechaEntReal,
            "fecha_sal_prev" => $peticion->cdbFechaSalPrev,
            "fecha_entrega" => $peticion->cdbfechaEntrega,
            "cita_previa" => $peticion->cdbCitaPrevia,
            "tipo_carga" => $peticion->cdbCodTipoCarga,
            "muelle" => $peticion->cdbMuelle,
            "muelle_adic" => $peticion->cdbMuelleAdic,
            "n_pallets" => $peticion->palets,
            "cliente" => json_encode($peticion->clientes),
            "camion_destino" => json_encode($peticion->destinos),
            "updated_at" => Carbon::now()
          ]);


        DB::table("db_empresa1_1.cal_albaranes_detalle")->where("albaran_id", $entrada->id)->delete();
        $numeros = [];
        foreach ($peticion->numeros as $numero) {
          $numeros[] = [
            "albaran_id" => $entrada->id,
            "numero" => $numero
          ];
        }
        DB::table("db_empresa1_1.cal_albaranes_detalle")->insert($numeros);
        DB::commit();
      } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
      }
    }

    DB::table("db_empresa1_1.cron")
      ->update(["entradas" => 0]);
  }

  public static function salidas()
  {
    /*
    $salidas_disponible = DB::table("db_empresa1_1.cron")
      ->select("salidas")
      ->first()->salidas;

    if ($salidas_disponible) return;

    DB::table("db_empresa1_1.cron")
      ->update(["salidas" => 1]);

    */

    $salidas = DB::table("db_empresa1_1.cal_albaranes")
      ->whereNull("deleted_at")
      ->where("clasificacion", 0)
      ->whereDate("created_at", Carbon::now()->format("Y-m-d"))
      ->select("id", "tipo", "numero")->get();
    foreach ($salidas as $salida) {
      $url = env("URL_API_CALENDARIO") . "salidas/$salida->tipo/$salida->numero";
      $peticion = Http::get($url);

      if ($peticion->failed()) {
        continue;
      }
      $peticion = $peticion->object();

      DB::beginTransaction();

      try {
        if (!empty($peticion->cdbCitaPrevia)) {

          $evento_id = DB::table("db_empresa1_1.cal_albaranes")->where("id", $salida->id)->select("evento_id")->first()->evento_id;
          // $albaran = DB::table("db_empresa1_1.cal_eventos")->where("id", $evento_id)->select("fecha_inicio", "fecha_fin")->first();

          // if ($albaran->fecha_inicio == $albaran->fecha_fin) {
          $fecha_inicio = (new Carbon($peticion->cdbCitaPrevia))->format("y-m-d H:i:s");
          $fecha_fin = (new Carbon($peticion->cdbCitaPrevia))->modify("+1 hours")->format("y-m-d H:i:s");
          DB::table("db_empresa1_1.cal_eventos")->where("id", $evento_id)
            ->update([
              "fecha_inicio" => $fecha_inicio,
              "fecha_fin" => $fecha_fin,
              "updated_at" => Carbon::now()
            ]);
          // }
        }


        DB::table("db_empresa1_1.cal_albaranes")->where("id", $salida->id)
          ->update([
            "fecha_ent_real" => $peticion->cdbFechaEntReal,
            "fecha_sal_prev" => $peticion->cdbFechaSalPrev,
            "fecha_entrega" => $peticion->cdbfechaEntrega,
            "cita_previa" => $peticion->cdbCitaPrevia,
            "tipo_carga" => $peticion->cdbCodTipoCarga,
            "muelle" => $peticion->cdbMuelle,
            "muelle_adic" => $peticion->cdbMuelleAdic,
            "n_pallets" => $peticion->palets,
            "cliente" => json_encode($peticion->clientes),
            "camion_destino" => json_encode($peticion->destinos),
            "camaras" => json_encode($peticion->camaras),
            "updated_at" => Carbon::now()
          ]);

        DB::table("db_empresa1_1.cal_albaranes_detalle")->where("albaran_id", $salida->id)->delete();
        $numeros = [];
        foreach ($peticion->numeros as $numero) {
          $numeros[] = [
            "albaran_id" => $salida->id,
            "numero" => $numero
          ];
        }
        DB::table("db_empresa1_1.cal_albaranes_detalle")->insert($numeros);
        DB::commit();
      } catch (\Throwable $th) {
        DB::rollBack();
        throw $th;
      }
    }

    DB::table("db_empresa1_1.cron")
    ->update(["salidas" => 0]);
  }
}
