<?php

namespace App\Http\Controllers;

use App\Helpers\CustomResponse;
use App\Helpers\FormatDate;
use App\Models\Calendarios;
use App\Models\Colores;
use App\Models\Eventos;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;

class CalendarioController extends Controller
{
  public function index(Request $request)
  {
    if (!$request->ajax()) {
      $colores = Colores::orderBy("nombre")->get();
      return view('calendarios', compact("colores"));
    } else {
      $calendarios = Calendarios::join("cal_colores as c", "c.id", "color_id")->select("cal_calendarios.id", "cal_calendarios.nombre", "cal_calendarios.descripcion", "cal_calendarios.created_at", "c.hexadecimal", "c.nombre as color")->get();
      $data = array();
      foreach ($calendarios as $key => $calendario) {
        $eliminar = (Auth::user()->existPermission(152)) ? '<button class="btn btn-danger btn-sm eliminar mr-1" id="' . $calendario->id . '"><i class="fa fa-fas fa-trash"></i></button>' : "";
        $ver = (Auth::user()->existPermission(157)) ? '<a href="/calendarios/' . $calendario->id . '"<button class="btn btn-success btn-sm mr-1"><i class="fa fa-fas fa-eye"></i></button></a>' : "";
        $editar = (Auth::user()->existPermission(160)) ? '<button class="btn btn-warning btn-sm editar mr-1" id="' . $calendario->id . '"><i class="fa fa-fas fa-edit"></i></button>' : "";
        $opciones = '<div class="d-flex">' . $ver . $editar . $eliminar . '</div>';
        $numero_eventos = Eventos::where("calendario_id", $calendario->id)->count();
        $subdata = array();
        $subdata[] = $key + 1;
        $subdata[] = $calendario->nombre;
        $subdata[] = $calendario->descripcion;
        $subdata[] = "<span style='background-color:$calendario->hexadecimal' class='badge badge-info'>$calendario->color</span>";
        $subdata[] = '<div class="text-center"><button class="btn btn-secondary btn-sm eventos mr-1" id="' . $calendario->id . '">' . $numero_eventos . '</button></div>';
        $subdata[] = FormatDate::format($calendario->created_at, true);
        $subdata[] = $opciones;
        $data[] = $subdata;
      }
      return response()->json(array("data" => $data));
    }
  }

  public static function buscar(Request $request)
  {
    $calendarios = explode(',', $request->calendarios);
    $eventos = Eventos::select("nombre as text", "id", "fecha_inicio", "fecha_fin")->whereIn("calendario_id", $calendarios)->where('nombre', 'LIKE', "%$request->search%")->orderBy("nombre")->get()->toArray();

    return response()->json(["results" => $eventos]);
  }

  public function editar($id)
  {
    $calendarios = Calendarios::where("id", $id)->first();
    return response()->json($calendarios);
  }

  public function calendario()
  {
    $calendario_id = Calendarios::orderByDesc("updated_at")->first()->id ?? null;
    if ($calendario_id) {
      return redirect("calendarios/$calendario_id");
    } else {
      return redirect("calendarios/");
    }
  }

  public function store(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'nombre' => 'required',
      'color' => 'required'
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    $evento = new Calendarios();
    $evento->nombre = $request->nombre;
    $evento->descripcion = $request->descripcion;
    $evento->color_id = $request->color;
    $evento->estado = 1;
    $evento->save();
    return CustomResponse::success("Calendario registrado correctamente");
  }

  public function update(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'nombre' => 'required',
      'color' => 'required'
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    $evento = Calendarios::findOrfail($request->id);
    $evento->nombre = $request->nombre;
    $evento->descripcion = $request->descripcion;
    $evento->color_id = $request->color;
    $evento->save();
    return CustomResponse::success("Calendario actualizado correctamente");
  }

  public function delete($id)
  {
    try {
      Calendarios::findOrFail($id)->delete();
      return CustomResponse::success("Calendario eliminada correctamente");
    } catch (ModelNotFoundException $th) {
      return CustomResponse::error("Calendario no encontrada");
    }
  }

  public function eventos($id, $calendario = null, Request $request)
  {
    if (!$calendario) {
      $response = Eventos::where("calendario_id", $id)->get();
      return response()->json($response);
    } else if ($calendario == "edit") {
      $DB = DB::connection("privada");
      $data = Eventos::join("cal_calendarios as cl", "cl.id", "calendario_id")->where("cal_eventos.id", $id)->select("cal_eventos.id", "cal_eventos.nombre", "cal_eventos.fecha_inicio", "cal_eventos.fecha_fin", "cal_eventos.descripcion",  "cal_eventos.color_id", "cl.nombre as calendario")->first();

      $fecha_inicio =  explode(" ", $data->fecha_inicio);
      $fecha_fin =  explode(" ", $data->fecha_fin);
      $data->fecha_inicio = $fecha_inicio[0];
      $data->hora_inicio = $fecha_inicio[1];
      $data->fecha_fin = $fecha_fin[0];
      $data->hora_fin = $fecha_fin[1];

      $data->ordenes_entrada = [];
      $data->ordenes_salida = [];
      $data->entradas_firmas = 0;
      $data->salidas_firmas = 0;

      if (Auth::user()->last_empresa_id == 1) {

        $data->ordenes_entrada = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 1)->where("evento_id", $id)->select("numero", "tipo", "id")->get()->toArray();
        $data->entradas_firmas = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 1)->where("evento_id", $id)->whereNotNull("firma")->count();
        $data->ordenes_salida = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 0)->where("evento_id", $id)->select("numero", "tipo", "id")->get()->toArray();
        $data->salidas_firmas = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 0)->where("evento_id", $id)->whereNotNull("firma")->count();
      }

      return response()->json($data);
    } else {
      $start = (new \DateTime($request->get('start')))->format('Y-m-d 00:00:00');
      $end = (new \DateTime($request->get('end')))->format('Y-m-d 23:59:59');

      $colorCalendario = [];
      if ($calendario == "ver" && count(explode(',', $id)) > 0) {
        $calendarios = explode(',', $id);

        $colorCalendario = Calendarios::join("cal_colores as c", "c.id", "color_id")->select("cal_calendarios.id", "cal_calendarios.nombre", "cal_calendarios.estado", "c.nombre as color")->whereIn("cal_calendarios.id", $calendarios)->get();

        $response = Eventos::join("cal_colores as c", "c.id", "color_id")->whereIn("calendario_id", $calendarios)->where("fecha_inicio", ">=", $start)->where("fecha_fin", "<=", $end)->select("cal_eventos.id", "cal_eventos.nombre", "cal_eventos.fecha_inicio", "cal_eventos.fecha_fin", "c.nombre as color", "c.hexadecimal", "cal_eventos.calendario_id")->get();
      } else {
        $colorCalendario = Calendarios::join("cal_colores as c", "c.id", "color_id")->select("cal_calendarios.id", "cal_calendarios.nombre", "cal_calendarios.estado", "c.nombre as color")->where("cal_calendarios.id", $id)->get();

        $response = Eventos::join("cal_colores as c", "c.id", "color_id")->where("cal_eventos.calendario_id", $id)->where("fecha_inicio", ">=", $start)->where("fecha_fin", "<=", $end)->select("cal_eventos.id", "cal_eventos.nombre", "cal_eventos.fecha_inicio", "cal_eventos.fecha_fin", "c.hexadecimal", "cal_eventos.calendario_id")->get();
      }
      $data = [];

      foreach ($response as $resp) {
        $dataCalendar = [];
        $dataCalendar["id"] = $resp->id;
        $dataCalendar["title"] = $resp->nombre;

        $hora_inicio = explode(" ", $resp->fecha_inicio)[1];
        $hora_fin = explode(" ", $resp->fecha_fin)[1];
        if ($hora_fin == $hora_inicio && $hora_inicio == "00:00:00") {
          $dataCalendar["allDay"] = true;
        }

        $dataCalendar["start"] = str_replace(" ", "T", $resp->fecha_inicio);
        $dataCalendar["end"] = str_replace(" ", "T", $resp->fecha_fin);
        $dataCalendar["backgroundColor"] = $resp->hexadecimal ?? "blue";
        // $dataCalendar["textColor"] = "#fff";
        foreach ($colorCalendario as $key => $calendario) {
          if ($resp->calendario_id == $calendario->id) {
            $dataCalendar["className"] = str_replace([" ", "á", "é", "í", "ó", "ú"], ["_", "a", "e", "i", "o", "u"], mb_strtolower($calendario->color));
          }
        }
        $dataCalendar = $this->validateEventoAlabaran($dataCalendar, $resp->calendario_id);
        $data[] = $dataCalendar;
      }
      return response()->json($data);
    }
  }

  private function validateEventoAlabaran($data, $calendario)
  {
    $alabaran = DB::connection("privada")->table("cal_albaranes as a")->where("evento_id", $data["id"])->select("id", "clasificacion", "fecha_entrega", "fecha_ent_real", "tipo_carga", "cita_previa","leido","firma","entre_cajas")->first();
    if ($alabaran) {
      if ($alabaran->clasificacion == 1 && ($alabaran->fecha_ent_real != null || $alabaran->cita_previa != null)) {

        if ($alabaran->cita_previa != null  && $alabaran->fecha_ent_real == null) {
          $date = Carbon::parse($alabaran->cita_previa);
          $data["start"] = str_replace(" ", "T", $alabaran->cita_previa);
          $data["end"] = str_replace(" ", "T", $date->addHours(1));
        } else if ($alabaran->fecha_ent_real != null) {
          $date = Carbon::parse($alabaran->fecha_ent_real);
          $data["start"] = str_replace(" ", "T", $alabaran->fecha_ent_real);
          $data["end"] = str_replace(" ", "T", $date->addHours(1));
        }
      } else if($alabaran->clasificacion == 0 && ($alabaran->fecha_entrega != null || $alabaran->cita_previa != null)) {
        if ($alabaran->cita_previa != null  && $alabaran->fecha_entrega == null) {
          $date = Carbon::parse($alabaran->cita_previa);
          $data["start"] = str_replace(" ", "T", $alabaran->cita_previa);
          $data["end"] = str_replace(" ", "T", $date->addHours(1));
        } else if ($alabaran->fecha_entrega != null) {
          $date = Carbon::parse($alabaran->fecha_entrega);
          $data["start"] = str_replace(" ", "T", $alabaran->fecha_entrega);
          $data["end"] = str_replace(" ", "T", $date->addHours(1));
        }
      }else{
        $data["allDay"] = true;
        // $data["start"] = explode("T", $data["start"])[0]."T"."00:00:00";
        // $data["end"] = explode("T", $data["end"])[0]."T"."00:00:00";
      }
      if ($alabaran->tipo_carga > 0) {
        $data["backgroundColor"] = "#db9d25";
        // } else if (($alabaran->clasificacion == 1 && $alabaran->clasificacion != null) || ($alabaran->clasificacion == 0 && $alabaran->clasificacion != null)) {
        //   $data["backgroundColor"] = "#586660";
      } else {
        $fecha_actual = Carbon::now()->format("Y-m-d");
        if ($alabaran->clasificacion == 1) {
          if ($this->sinMuellesEntradas([$calendario], $fecha_actual, $alabaran->id)) {
            $data["backgroundColor"] = "#e6d94f";
          } else if ($this->conMuellesEntradas([$calendario], $fecha_actual, $alabaran->id)) {
            if($alabaran->fecha_entrega != null && ($alabaran->leido == 0 || $alabaran->firma == null || $alabaran->entre_cajas == null)) {
              $data["backgroundColor"] = "#d50001";
            }else{
              $data["backgroundColor"] = "#e6d94f";
            }
          } else if ($alabaran->fecha_entrega != null) {
            $data["backgroundColor"] = "#586660";
          }
        } else {
          if ($this->sinMuellesSalidas([$calendario], $fecha_actual, $alabaran->id)) {
            $data["backgroundColor"] = "#e6d94f";
          } else if ($this->conMuellesSalidas([$calendario], $fecha_actual, $alabaran->id)) {
            if($alabaran->fecha_ent_real != null && ($alabaran->leido == 0 || $alabaran->firma == null || $alabaran->entre_cajas == null)) {
              $data["backgroundColor"] = "#d50001";
            }else{
              $data["backgroundColor"] = "#e6d94f";
            }
          } else if ($alabaran->fecha_entrega != null) {
            $data["backgroundColor"] = "#586660";
          }
        }
      }
    }
    return $data;
  }

  public function verCalendario($id)
  {
    $colores = Colores::orderBy("nombre")->get();
    if (Auth::user()->existPermission(159)) {
      $arrastrable = 1;
    } else {
      $arrastrable = 0;
    }
    $olano = (Auth::user()->last_empresa_id == 1) ? true : false;
    return view('calendario', compact('id', 'colores', 'arrastrable', 'olano'));
  }

  public function imprimirAlbaran($albaran)
  {
    return view('imprimir_albaran', compact('albaran'));
  }

  public function storeEventos(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'titulo' => 'required',
      'fecha_inicio' => 'required',
      'fecha_fin' => 'required'
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    $hora_inicio =  $request->hora_inicio;
    $hora_fin = $request->hora_fin;
    $evento = new Eventos();
    $evento->nombre = $request->titulo;
    $evento->descripcion = $request->descripcion;
    $evento->fecha_inicio = $request->fecha_inicio . " " . $hora_inicio;
    $evento->fecha_fin = $request->fecha_fin . " " . $hora_fin;
    $evento->color_id = $request->color;
    $evento->calendario_id = $request->calendario_id;
    $evento->save();
    $color = Colores::where("id", $request->color)->first();
    $evento->hexadecimal = $color->hexadecimal ?? "blue";
    $calendario =  Colores::join("cal_calendarios as c", "c.color_id", "cal_colores.id")->where("c.id", $request->calendario_id)->select("cal_colores.nombre")->first();
    $evento->className = str_replace([" ", "á", "é", "í", "ó", "ú"], ["_", "a", "e", "i", "o", "u"], mb_strtolower($calendario->nombre));
    return CustomResponse::success("Evento registrado correctamente", $evento);
  }

  public function updateEventos(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'titulo' => 'required',
      'fecha_inicio' => 'required',
      'fecha_fin' => 'required'
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    $evento = Eventos::find($request->id);
    $hora_inicio =  $request->hora_inicio;
    $hora_fin = $request->hora_fin;
    $evento->nombre = $request->titulo;
    $evento->descripcion = $request->descripcion;
    $evento->fecha_inicio = $request->fecha_inicio . " " . $hora_inicio;
    $evento->fecha_fin = $request->fecha_fin . " " . $hora_fin;
    $evento->color_id = $request->color;
    $evento->save();
    return CustomResponse::success("Evento actualizado correctamente");
  }

  public function updateEventosDate(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'id' => 'required',
      'fecha_inicio' => 'required',
      'fecha_fin' => 'required'
    ]);

    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }

    $evento = Eventos::find($request->id);
    $hora_inicio =  $request->hora_inicio;
    $hora_fin = $request->hora_fin;
    $evento->fecha_inicio = $request->fecha_inicio . " " . $hora_inicio;
    $evento->fecha_fin = $request->fecha_fin . " " . $hora_fin;
    $evento->save();
    return CustomResponse::success("Evento actualizado correctamente");
  }

  public function deleteEventos($id_evento)
  {
    try {
      Eventos::findOrFail($id_evento)->delete();
      $DB = DB::connection("privada");
      $DB->table("cal_albaranes")->where("evento_id", $id_evento)->update(["deleted_at" => Carbon::now()]);

      return CustomResponse::success("Evento eliminado correctamente");
    } catch (ModelNotFoundException $th) {
      return CustomResponse::error("Evento no encontrado");
    }
  }

  public function verCalendarios($calendario_id)
  {
    $calendarios = Calendarios::join("cal_colores as c", "c.id", "color_id")->select("cal_calendarios.id", "cal_calendarios.nombre", "cal_calendarios.estado", "c.nombre as color")->get();
    foreach ($calendarios as $key => $calendario) {
      if ($calendario->id == $calendario_id) {
        $calendarios[$key]->estado = 1;
      }
      $calendarios[$key]->color  = str_replace([" ", "á", "é", "í", "ó", "ú"], ["_", "a", "e", "i", "o", "u"], mb_strtolower($calendario->color));
    }
    return $calendarios;
  }

  public function updateCalendarioEstado(Request $request)
  {
    foreach ($request->all() as $key => $value) {
      $calendario = Calendarios::find($value["id"]);
      $calendario->estado = $value["estado"];
      $calendario->save();
    }
  }

  public function monitoreos($calendarios)
  {
    $calendarios = explode(',', $calendarios);
    $fecha_actual = Carbon::now()->format("Y-m-d");
    $data = [
      "sin_muelle" => [],
      "con_muelle" => [],
      "seguimiento" => []
    ];
    if (!empty($calendarios)) {
      $sin_muelles = self::sinMuelles($calendarios, $fecha_actual);
      $con_muelles = self::conMuelles($calendarios, $fecha_actual);
      $seguimiento = self::seguimiento($calendarios, $fecha_actual);
      $data = [
        "sin_muelle" => $sin_muelles,
        "con_muelle" => $con_muelles,
        "seguimiento" => $seguimiento
      ];
    }
    return $data;
  }

  private static function sinMuelles($calendarios, $fecha_actual)
  {
    $data = [];
    $entradas = self::sinMuellesEntradas($calendarios, $fecha_actual);
    $filtro_entradas = array_unique(array_values(array_column($entradas, "evento_id")));
    $salidas = self::sinMuellesSalidas($calendarios, $fecha_actual, null, $filtro_entradas);
    if (count($entradas) > 0) {
      $data = array_merge($data, $entradas);
    }
    if (count($salidas) > 0) {
      $data = array_merge($data, $salidas);
    }

    return $data;
  }

  private static function sinMuellesEntradas($calendarios, $fecha_actual, $id = null)
  {
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 1)
      ->whereNotNull("a.fecha_ent_real")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      // ->whereNull("a.fecha_entrega")
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual);

    if ($id) {
      $eventos->where("a.id", $id);
    }

    return $eventos->get()->toArray();
  }

  private static function sinMuellesSalidas($calendarios, $fecha_actual, $id = null, $filtros = [])
  {
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->whereNotIn("a.evento_id", $filtros)
      ->where("a.clasificacion", 0)
      ->whereNotNull("a.fecha_entrega")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      // ->whereNull("a.fecha_ent_real")
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual);

    if ($id) {
      $eventos->where("a.id", $id);
    }

    return $eventos->get()->toArray();
  }

  private static function conMuelles($calendarios, $fecha_actual)
  {
    $data = [];
    $entradas = self::conMuellesEntradas($calendarios, $fecha_actual);
    $filtro_entradas = array_unique(array_values(array_column($entradas, "evento_id")));
    $salidas = self::conMuellesSalidas($calendarios, $fecha_actual, null, $filtro_entradas);
    if (count($entradas) > 0) {
      $data = array_merge($data, $entradas);
    }
    if (count($salidas) > 0) {
      $data = array_merge($data, $salidas);
    }

    return $data;
  }

  private static function conMuellesEntradas($calendarios, $fecha_actual, $id = null)
  {
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 1)
      ->whereNotNull("a.fecha_sal_prev")
      ->whereNotNull("a.muelle")
      ->where(function ($query) {
        $query->whereNull("a.fecha_entrega")
          ->orWhere("a.leido", 0)
          ->orWhereNull("a.entre_cajas")
          ->orWhereNull("a.firma");
        })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual);

    if ($id) {
      $eventos->where("a.id", $id);
    }

    return $eventos->get()->toArray();
  }

  private static function conMuellesSalidas($calendarios, $fecha_actual, $id = null, $filtros = [])
  {
    $eventos = Eventos::select("cal_eventos.nombre", "a.id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->whereNotIn("a.evento_id", $filtros)
      ->where("a.clasificacion", 0)
      ->whereNotNull("a.fecha_sal_prev")
      ->whereNotNull("a.muelle")
      ->where(function ($query) {
        $query->whereNull("a.fecha_ent_real")
          ->orWhere("a.leido", 0)
          ->orWhereNull("a.entre_cajas")
          ->orWhereNull("a.firma");
        })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function seguimiento($calendarios, $fecha_actual)
  {
    $data = [];
    $sinEntradas = self::sinCitaPreviaEntradas($calendarios, $fecha_actual);
    $filtro_sin_entradas = array_unique(array_values(array_column($sinEntradas, "evento_id")));
    $sinsalidas = self::sinCitaPreviaSalidas($calendarios, $fecha_actual, null, $filtro_sin_entradas);
    $conEntradas = self::conCitaPreviaEntradas($calendarios, $fecha_actual);
    $filtro_con_entradas = array_unique(array_values(array_column($sinEntradas, "evento_id")));
    $consalidas = self::conCitaPreviaSalidas($calendarios, $fecha_actual, null, $filtro_con_entradas);
    $conEntradasDestiempo = self::conCitaPreviaEntradasDestiempo($calendarios, $fecha_actual);
    $filtro_con_entradas_destiempo = array_unique(array_values(array_column($sinEntradas, "evento_id")));
    $conSalidasDestiempo = self::conCitaPreviaSalidasDestiempo($calendarios, $fecha_actual, null, $filtro_con_entradas_destiempo);
    if (count($sinEntradas) > 0) {
      $data = array_merge($data, $sinEntradas);
    }
    if (count($sinsalidas) > 0) {
      $data = array_merge($data, $sinsalidas);
    }
    if (count($conEntradas) > 0) {
      $data = array_merge($data, $conEntradas);
    }
    if (count($consalidas) > 0) {
      $data = array_merge($data, $consalidas);
    }
    if (count($conEntradasDestiempo) > 0) {
      $data = array_merge($data, $conEntradasDestiempo);
    }
    if (count($conSalidasDestiempo) > 0) {
      $data = array_merge($data, $conSalidasDestiempo);
    }

    return $data;
  }

  private static function sinCitaPreviaEntradas($calendarios, $fecha_actual, $id = null)
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 1)
      ->whereNull("a.cita_previa")
      ->whereNotNull("a.fecha_ent_real")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_ent_real,'$now')"), ">=", 90);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function sinCitaPreviaSalidas($calendarios, $fecha_actual, $id = null, $filtros = [])
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 0)
      ->whereNotIn("a.evento_id", $filtros)
      ->whereNull("a.cita_previa")
      ->whereNull("a.fecha_sal_prev")
      ->whereNull("a.deleted_at")
      ->whereNotNull("a.fecha_entrega")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_entrega,'$now')"), ">=", 90);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function conCitaPreviaEntradas($calendarios, $fecha_actual, $id = null)
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 1)
      ->whereNotNull("a.cita_previa")
      ->whereNotNull("a.fecha_ent_real")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.cita_previa,a.fecha_ent_real)"), "<=", 30)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_ent_real,'$now')"), ">=", 30);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function conCitaPreviaEntradasDestiempo($calendarios, $fecha_actual, $id = null)
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->where("a.clasificacion", 1)
      ->whereNotNull("a.cita_previa")
      ->whereNotNull("a.fecha_ent_real")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.cita_previa,a.fecha_ent_real)"), ">", 30)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_ent_real,'$now')"), ">=", 90);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function conCitaPreviaSalidas($calendarios, $fecha_actual, $id = null, $filtros = [])
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->whereNotIn("a.evento_id", $filtros)
      ->where("a.clasificacion", 0)
      ->whereNotNull("a.cita_previa")
      ->whereNotNull("a.fecha_entrega")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.cita_previa,a.fecha_entrega)"), "<=", 30)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_entrega,'$now')"), ">=", 30);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  private static function conCitaPreviaSalidasDestiempo($calendarios, $fecha_actual, $id = null, $filtros = [])
  {
    $now = Carbon::now();
    $eventos = Eventos::select("cal_eventos.nombre", "a.id", "a.evento_id")
      ->join("cal_albaranes as a", "cal_eventos.id", "a.evento_id")
      ->whereIn("calendario_id", $calendarios)
      ->whereNotIn("a.evento_id", $filtros)
      ->where("a.clasificacion", 0)
      ->whereNotNull("a.cita_previa")
      ->whereNotNull("a.fecha_entrega")
      ->where(function ($query) {
        $query->whereNull("a.muelle")
          ->orWhere("a.muelle", 0);
      })
      ->whereNull("a.deleted_at")
      ->whereDate("cal_eventos.fecha_inicio", $fecha_actual)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.cita_previa,a.fecha_entrega)"), ">", 30)
      ->where(DB::raw("TIMESTAMPDIFF(MINUTE,a.fecha_entrega,'$now')"), ">=", 90);
    if ($id) {
      $eventos->where("a.id", $id);
    }
    return $eventos->get()->toArray();
  }

  public function buscarAlbaran($clasificacion, $tipo, $numero, Request $request)
  {
    $albaran_id = $request->get("albaran_id");

    $DB = DB::connection("privada");

    $clasificacion_type = ($clasificacion == "entradas") ? 1 : 0;

    $exist = $DB->table("cal_albaranes")
      ->where("clasificacion", $clasificacion_type)
      ->where("tipo", $tipo)
      ->where("numero", $numero)
      ->where("id", "!=", $albaran_id)
      ->whereNull("deleted_at")
      ->select("id")
      ->first()->id ?? null;

    if ($exist) {
      return response()->json(["message" => "Este albaran ya existe en otro evento"]);
    }

    $url = env("URL_API_CALENDARIO") . "$clasificacion/$tipo/$numero";
    try {
      $peticion = Http::get($url);
    } catch (\Throwable $th) {
      return response()->json(["message" => $th->getMessage()]);
    }

    if ($peticion->failed()) {
      $data = [];
    }
    $peticion = $peticion->object();
    $data = [];
    if (isset($peticion->cdbCodTipoCarga)) {

      if (!isset($peticion->cdbEstadoParte)) {
        $peticion->cdbEstadoParte = 1;
      }

      if ($peticion->cdbEstadoParte == 0 || $peticion->cdbEstadoParte == null) {
        return response()->json(["message" => "Este albaran no tiene tarea asignada"]);
      }

      $data = [
        "tipo_carga" => $peticion->cdbCodTipoCarga,
        "fecha_sal_prev" => $peticion->cdbFechaSalPrev,
        "fecha_entrega" => $peticion->cdbfechaEntrega,
        "cita_previa" => $peticion->cdbCitaPrevia,
        "muelle" => $peticion->cdbMuelle,
        "muelle_adic" => $peticion->cdbMuelleAdic,
        "fecha_ent_real" => $peticion->cdbFechaEntReal,
        "palets" => $peticion->palets,
        "numeros" => $peticion->numeros,
        "clientes" => $peticion->clientes ?? [],
        "destinos" => $peticion->destinos ?? [],
        "camaras" => $peticion->camaras ?? [],
      ];
    }


    return response()->json($data);
  }

  public function actualizarLeido($albaran_id)
  {
    $DB = DB::connection("privada");
    $albaranes = $DB->table("cal_albaranes_detalle")->where("albaran_id", $albaran_id)->select("numero")->get()->toArray();
    $numeros = array_values(array_column($albaranes, "numero"));
    $url = env("URL_API_CALENDARIO") . "estado";
    try {
      $peticion = Http::put($url, ["numeros" => $numeros]);
      if ($peticion->failed()) {
        return response()->json(["icon" => "success", "title" => "Algo salio mal", "message" => "Error"]);
      }
      $peticion = $peticion->object();
      $DB->table("cal_albaranes")->where("id", $albaran_id)->update(["leido" => 1]);
      return response()->json(["icon" => "success", "title" => "Buen trabajo", "message" => $peticion]);
    } catch (\Throwable $th) {
      return response()->json(["icon" => "success", "title" => "Algo salio mal", "message" => $th->getMessage()]);
    }
  }

  public function buscarAlbaranExistente($id)
  {
    $DB = DB::connection("privada");
    $albaranes = $DB->table("cal_albaranes")->where("id", $id)->first();
    if (!empty(session('formato_fecha'))) {
      $albaranes->cita_previa = (!empty($albaranes->cita_previa)) ? (new Carbon($albaranes->cita_previa))->format(session('formato_fecha')) : "";
      $albaranes->fecha_ent_real = (!empty($albaranes->fecha_ent_real)) ? (new Carbon($albaranes->fecha_ent_real))->format(session('formato_fecha')) : "";
      $albaranes->fecha_entrega = (!empty($albaranes->fecha_entrega)) ? (new Carbon($albaranes->fecha_entrega))->format(session('formato_fecha')) : "";
      $albaranes->fecha_sal_prev = (!empty($albaranes->fecha_sal_prev)) ? (new Carbon($albaranes->fecha_sal_prev))->format(session('formato_fecha')) : "";
    }
    $albaranes->firma = (!empty($albaranes->firma)) ? asset("images/firmas/$albaranes->firma") : null;
    $numeros = $DB->table("cal_albaranes_detalle")->where("albaran_id", $id)->select("numero")->get()->toArray();
    $albaranes->cliente = json_decode($albaranes->cliente);
    $albaranes->camaras = json_decode($albaranes->camaras);
    $albaranes->camion_destino = json_decode($albaranes->camion_destino);
    $albaranes->numeros = array_values(array_column($numeros, "numero"));
    $albaranes->evento = Eventos::where("id", $albaranes->evento_id)->select("nombre")->first()->nombre;
    return response()->json($albaranes);
  }

  public function orden(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'tipo' => 'required',
      'numero' => 'required',
      'cliente' => 'required'
    ]);
    if ($validator->fails()) {
      return CustomResponse::error($validator->errors()->first(), 200);
    }
    $DB = DB::connection("privada");
    $DB->beginTransaction();
    $empresa_id = Auth::user()->last_empresa_id;
    $url_firma = null;
    if ($request->albaran_id == "") {

      if (!empty($request->imagen)) {
        $baseFromJavascript = $request->imagen;
        $result = str_replace(array("[removed]"), 'data:image/svg+xml;base64,', $baseFromJavascript);
        $base_to_php = explode(',', $result);
        $data = base64_decode($base_to_php[1]);
        $time = time();
        $image = Image::make($data);
        $url_firma = "firma_{$empresa_id}_$time.png";
        $image->save("images/firmas/$url_firma");
      }
    } else {
      if (!empty($request->imagen)) {
        $baseFromJavascript = $request->imagen;
        $result = str_replace(array("[removed]"), 'data:image/svg+xml;base64,', $baseFromJavascript);
        $base_to_php = explode(',', $result);
        $data = base64_decode($base_to_php[1]);
        $time = time();
        $image = Image::make($data);
        $url_firma = "firma_{$empresa_id}_$time.png";
        $image->save("images/firmas/$url_firma");
      } else {
        $url_firma = $DB->table("cal_albaranes")->where("id", $request->albaran_id)->first()->firma;
      }
    }

    $data = [
      "numero" => $request->numero,
      "clasificacion" => intval($request->clasificacion),
      "tipo" => intval($request->tipo),
      "firma" => $url_firma,
      "evento_id" => $request->evento_id, //falta
      "nombre_operario" => $request->nombre_operario,
      "entre_cajas" => $request->entre_cajas,
      "observacion" => $request->observaciones,
    ];

    try {
      //code...
      if ($request->albaran_id == "") {
        
        $data["cliente"] = $request->cliente;
        $data["camaras"] = $request->camaras;
        $data["camion_destino"] = $request->camion_destino;
        $data["cita_previa"] = $request->cita_previa;
        $data["muelle"] = $request->muelle;
        $data["muelle_adic"] = $request->muelle_adic;
        $data["fecha_ent_real"] = $request->fecha_real;
        $data["fecha_sal_prev"] = $request->fecha_sal_prev;
        $data["fecha_entrega"] = $request->fecha_entrega;
        $data["n_pallets"] = $request->n_pallets;
        $data["olano_pda"] = $request->olano_pda;
        $data["created_at"] = Carbon::now();
        $insert = $DB->table("cal_albaranes")->insertGetId($data);
        $numeros = json_decode($request->numeros, true);
        foreach ($numeros as $numero) {
          $DB->table("cal_albaranes_detalle")->insert(["albaran_id" => $insert, "numero" => $numero]);
        }
        $request->albaran_id = $insert;
      } else {
        $data["updated_at"] = Carbon::now();
        $DB->table("cal_albaranes")->where("id", $request->albaran_id)->update($data);
      }
      $DB->commit();
      $data_response = [];
      if ($request->clasificacion == 1) {
        $albaranes = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("evento_id", $request->evento_id)->where("clasificacion", 1)->select("id", "numero", "tipo")->get()->toArray();
        $entradas_firmas = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 1)->where("evento_id", $request->evento_id)->whereNotNull("firma")->count();

        $data_response = [
          "entradas" => $albaranes,
          "entradas_firmas" => $entradas_firmas
        ];
      } else {
        $albaranes = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("evento_id", $request->evento_id)->where("clasificacion", 0)->select("id", "numero", "tipo")->get()->toArray();

        $salidas_firmas = $DB->table("cal_albaranes")->whereNull("deleted_at")->where("clasificacion", 0)->where("evento_id", $request->evento_id)->whereNotNull("firma")->count();

        $data_response = [
          "salidas" => $albaranes,
          "salidas_firmas" => $salidas_firmas
        ];
      }
      return CustomResponse::success("Datos guardados correctamente", $data_response);
    } catch (\Throwable $th) {
      $DB->rollBack();
      return CustomResponse::error($th->getMessage(), 200);
      // return CustomResponse::error("Hubo un problema al guardar la información", 200);
    }
  }
}
