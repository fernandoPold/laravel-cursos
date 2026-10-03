<?php

namespace App\Services;

use App\Models\Curso;
use App\Services\Contracts\CursoServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\Log;

class CursoService implements CursoServiceInterface
{
    public function obtenerTodos(): Collection
    {
        return Curso::where('estado', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function obtenerPorId(int $id): Curso
    {
        $curso = Curso::find($id);

        if (!$curso) {
            throw new Exception("El curso solicitado con ID {$id} no existe o no se encuentra disponible.");
        }

        return $curso;
    }

    public function registrarCurso(array $datos): Curso
    {
        // Regla de Negocio: Validar duplicidad de código
        if (Curso::where('codigo', $datos['codigo'])->exists()) {
            throw new Exception("El código '{$datos['codigo']}' ya se encuentra registrado en el sistema.");
        }

        // Regla de Negocio: El precio no puede ser negativo
        if ($datos['precio'] < 0) {
            throw new Exception("El precio del curso no puede ser un valor negativo.");
        }

        try {
            return Curso::create($datos);
        } catch (Exception $e) {
            Log::error("Error al registrar el curso: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno al intentar guardar el curso.");
        }
    }
}
