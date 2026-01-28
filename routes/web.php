<?php

use Illuminate\Support\Facades\Route;
use APP\Http\Controllers\HomeController;
use APP\Http\Controllers\PostController;
use APP\Http\Controllers\PrincipalController;

/*Route::get('/', function () {
    return view('welcome');  }); */

 Route::get('/hello', HomeController::class);


