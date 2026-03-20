<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\DataTables;


class HomeController extends Controller
{
    public function __invoke(){
        return view ('hello');
    }

    public function empresa(){
        $datos["nombre"]="Alba Gabriela Cruz Gonzalez";
        $datos["fecha"]="2026-02-03";
        $datos["actividad"]="Desarrollo de Software";
        $datos["descripcion_about"]="Empresa dedicada al desarrollo de software a la medida de sus clientes";
        $datos["texto_ejemplo"]="Aquí va la descripción del texto de ejemplo";

        $usuarios=new Pagina();
        $datos["listadousuarios"]=$usuarios->ObtenerListado();
        return view('empresa', $datos);
    }

public function update(Request $request){
    $usuarios = new Pagina();
    $respuesta = $usuarios->BuscarId($request->id);

    if(!empty($respuesta)){
        $respuesta->name = $request->name;
        $respuesta->calle = $request->calle;
        $respuesta->save();
    }

    return $respuesta;
}
  // Se añade el método para eliminación lógica
    public function eliminacion_logica($id)
    {
        $pagina = Pagina::findOrFail($id);
        $pagina->is_active = 0; 
        $pagina->save();

        return response()->json(['message' => 'El registro ha sido desactivado.']);
    }

    // Se añade el método para eliminación física
    public function eliminacion_fisica($id)
    {
        $pagina = Pagina::findOrFail($id);
        $pagina->delete(); 

        return response()->json(['message' => 'El registro ha sido borrado permanentemente.']);
    }
}

