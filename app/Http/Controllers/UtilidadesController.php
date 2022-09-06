<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UtilidadesController extends Controller
{
  public function empresas(Request $request)
  {
    if($request->usuario_id){
      $last_bussine_id = DB::table("usuarios")->where("id", $request->usuario_id)->first()->last_empresa_id;
      $usuario_id =$request->usuario_id;

    }else{
      $usuario_id = Auth::id();
      $last_bussine_id = Auth::user()->last_empresa_id;
    }
    $empresas = DB::select("SELECT e.id, e.razon_social as nombre FROM empresas as e, usuarios_empresas as ue WHERE e.id = ue.empresa_id AND ue.usuario_id =" . $usuario_id);
    $data["empresas"] = $empresas;
    $data["last_empresa_id"] = $last_bussine_id;
    return  response()->json($data);
  }

  public function establecerEmpresa(Request $request, $id)
  {
    if($request->usuario_id){
      $usuario_id =$request->usuario_id;

    }else{
      $usuario_id = Auth::id();
    }
    $empresas = DB::table("empresas")->where("id",$id)->first();
    DB::table("usuarios")->where("id",$usuario_id )->update([
      "last_empresa_id" => $id,
      "base_datos" => $empresas->base_datos
    ]);
    $configuracion = DB::table("configuracion as c")->join("paises as p","p.id","c.pais_id")->where("empresa_id", $id)->select("c.formato_fecha","p.utc","c.decimales")->first();
    $request->session()->put('formato_fecha', $configuracion->formato_fecha);
    $request->session()->put('utc', $configuracion->utc);
    $request->session()->put('decimales', $configuracion->decimales);
    return  response()->json(true);
  }
}
