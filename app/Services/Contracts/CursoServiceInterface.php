<?php

namespace App\Services\Contracts;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Collection;

interface CursoServiceInterface
{
    public function obtenerTodos(): Collection;
    public function obtenerPorId(int $id): Curso;
    public function registrarCurso(array $datos): Curso;
    public function actualizarCurso(int $id, array $datos): Curso;
    public function eliminarCurso(int $id): bool;
}
