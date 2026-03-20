<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrincipalController;
use App\Models\Pagina;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/hello',HomeController::class);
Route::get('post/mensaje',[PostController::class, 'Mensaje']);
Route::get('post/about/{param?}/{name?}', [PostController::class, 'About']);
Route::get('/empresa',[HomeController::class,'empresa'])->name('empresa');

Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact', function () {
    $nombre = "Alba Cruz Gonzalez";
    return view('contact', ['nombre' => $nombre,'carrera' => 'Licenciatura en Administración de TIC']);
})->name('contact');

//Insertar nuevos registros a la tabla

Route::get('nuevoregistro', function(){

    $pagina = new Pagina;
    $pagina->name = 'CARLOS';
    $pagina->email = 'maria@gmail.com';
    $pagina->email_verified_at = date('Y-m-d');
    $pagina->password = '123456';
    $pagina->avatar = 'user.png';
    $pagina->telefono = '999999';
    $pagina->calle = 89;
    $pagina->is_active = 1;
    $pagina->save();

    return $pagina;
});

// Definimos el método para buscar por el id
// Para obtener unicamente un registro
Route::get('buscarpaginaid', function(){

    $post = Pagina::find(3);
    return $post;

});

// Definimos el método para buscar por un campo determinado
Route::get('buscarxname', function(){

    $post = Pagina::where('name', 'carlos')->first();
    return $post;

});

// Para recuperar más de un registro
Route::get('obtenerTodos', function(){

    $post = Pagina::all();
    return $post;

});

// Definimos el método para cambiar un registro
Route::get('updatename', function(){

    $post = Pagina::where('name', 'CARLOS')->first();
    $post->email = 'carlos2026@gmail.com';
    $post->save();

    return $post;

});

// Definimos un método para obtener una lista conforme a un criterio determinado
// Para obtener más de un registro
Route::get('filter', function(){

    //$post = Pagina::where('calle', 'like', '%123%')->get();
    $post = Pagina::where('calle', 'like', '%123%')->orderBy('id', 'desc')->get();
    return $post;

});

// Para especificar unicamente los campos que quiera
Route::get('trescampos', function(){

    $post = Pagina::select('name', 'email', 'telefono')->get();
    return $post;

});

// Conforme a una selección solamente traerme un cierto número de registros
Route::get('filtroxnumreg', function(){

    $post = Pagina::select('name', 'email')->orderBy('name')->take(2)->get();
    return $post;

});

// Para eliminar un determinado registro
Route::get('eliminar_registro', function(){

    $post = Pagina::find(9);
    $post->delete();
    return "Eliminado";

});

// Obtener la fecha conforme a un formato
Route::get('obtenerfechaformato', function(){

    $post = Pagina::select('name', 'email', 'created_at')->find(3);
    return $post;

});

// Obtener el valor de is_active
Route::get('obtenerestatus', function(){

    $post = Pagina::find(1);
    dd($post->is_active);

});
// El siguiente método se debe de llamar mediante un método de tipo request (por ejemplo, utilizando AJAX o Postman)
Route::put('/actualizar-dato/{id}', [HomeController::class, 'update'])->name('dato.update');

// Se añade la ruta para eliminación lógica
Route::delete('/paginas/{id}/eliminacion-logica', [HomeController::class, 'eliminacion_logica'])->name('paginas.eliminacion-logica');

//Se añade la ruta para eliminación física
Route::delete('/paginas/{id}/eliminacion-fisica', [HomeController::class, 'eliminacion_fisica'])->name('paginas.eliminacion-fisica');