<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;

Route::redirect('/', '/cursos');

Route::resource('cursos', CursoController::class)->only([
    'index', 'create', 'store', 'show'
]);
