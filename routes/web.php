<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::redirect('/', '/cursos');

// Eliminamos el ->only(...) para habilitar el soporte CRUD completo en la navegación
Route::resource('cursos', CursoController::class);
