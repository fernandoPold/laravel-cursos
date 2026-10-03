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

        if (!$curso || !$curso->estado) {
            throw new Exception("El curso solicitado no existe o no se encuentra disponible.");
        }

        return $curso;
    }

    public function registrarCurso(array $datos): Curso
    {
        try {
            return Curso::create($datos);
        } catch (Exception $e) {
            Log::error("Error crítico al registrar el curso: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno en el servidor al intentar guardar el curso.");
        }
    }

    public function actualizarCurso(int $id, array $datos): Curso
    {
        try {
            $curso = $this->obtenerPorId($id);
            $curso->update($datos);
            return $curso;
        } catch (Exception $e) {
            Log::error("Error crítico al actualizar el curso ID {$id}: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno al intentar actualizar los datos del curso.");
        }
    }

    public function eliminarCurso(int $id): bool
    {
        try {
            $curso = $this->obtenerPorId($id);
            // Hacemos un borrado lógico cambiando el estado a falso para mantener la integridad de los datos
            return $curso->update(['estado' => false]);
        } catch (Exception $e) {
            Log::error("Error crítico al eliminar el curso ID {$id}: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno al intentar dar de baja el curso.");
        }
    }
}
