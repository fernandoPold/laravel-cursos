<?php

namespace App\Services;

use App\Models\Curso;
use App\Services\Contracts\CursoServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Clase CursoService
 * 
 * Implementación de la lógica de negocio y reglas de dominio para la gestión de cursos.
 * Actúa como la capa intermedia desvinculada de la infraestructura de controladores.
 */
class CursoService implements CursoServiceInterface
{
    /**
     * Obtiene todos los cursos activos ordenados cronológicamente por su fecha de creación.
     * 
     * @return Collection Colección de modelos Curso elegibles.
     */
    public function obtenerTodos(): Collection
    {
        return Curso::where('estado', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Recupera un curso específico por su identificador único.
     * 
     * @param int $id Identificador único del registro.
     * @return Curso Instancia del modelo Curso.
     * @throws Exception Si el curso no existe o ha sido dado de baja lógicamente.
     */
    public function obtenerPorId(int $id): Curso
    {
        $curso = Curso::find($id);

        if (!$curso || !$curso->estado) {
            throw new Exception("El curso solicitado con ID {$id} no existe o no se encuentra disponible.");
        }

        return $curso;
    }

    /**
     * Procesa y persiste un nuevo curso tras la validación de formato.
     * 
     * @param array $datos Matriz de datos sanitizados del formulario.
     * @return Curso Instancia del modelo persistido.
     * @throws Exception En caso de fallas imprevistas en la persistencia.
     */
    public function registrarCurso(array $datos): Curso
    {
        try {
            return Curso::create($datos);
        } catch (Exception $e) {
            Log::error("Error crítico al registrar el curso: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno en el servidor al intentar guardar el curso.");
        }
    }

    /**
     * Modifica los atributos de un curso existente manteniendo las excepciones útiles.
     * 
     * @param int $id Identificador único del curso.
     * @param array $datos Datos con las modificaciones requeridas.
     * @return Curso Instancia modificada y actualizada.
     * @throws Exception Si la base de datos falla o hereda una excepción previa.
     */
    public function actualizarCurso(int $id, array $datos): Curso
    {
        // Se ejecuta fuera del try-catch para no pisar el mensaje de "No existe" detectado por la auditoría
        $curso = $this->obtenerPorId($id);

        try {
            $curso->update($datos);
            return $curso;
        } catch (Exception $e) {
            Log::error("Error crítico al actualizar el curso ID {$id}: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno al intentar actualizar los datos del curso.");
        }
    }

    /**
     * Ejecuta una baja lógica alterando el estado del curso en la persistencia.
     * 
     * @param int $id Identificador del curso a eliminar.
     * @return bool True si la operación fue exitosa.
     * @throws Exception Si hereda fallas del recolector por ID o caídas de BD.
     */
    public function eliminarCurso(int $id): bool
    {
        $curso = $this->obtenerPorId($id);

        try {
            return $curso->update(['estado' => false]);
        } catch (Exception $e) {
            Log::error("Error crítico al eliminar el curso ID {$id}: " . $e->getMessage());
            throw new Exception("Ocurrió un error interno al intentar dar de baja el curso.");
        }
    }
}
