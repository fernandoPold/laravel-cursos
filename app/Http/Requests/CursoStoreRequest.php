<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase CursoStoreRequest
 * 
 * Gestiona el aislamiento, la sanitización y las reglas de validación estructurales 
 * para las solicitudes de almacenamiento y actualización de cursos.
 */
class CursoStoreRequest extends FormRequest
{
    /**
     * Determina si el actor de la petición posee autorización de acceso.
     * 
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas semánticas y de límites numéricos para mitigar desbordes.
     * 
     * @return array
     */
    public function rules(): array
    {
        // Se extrae el ID del curso de la ruta si corresponde a una actualización para ignorar su propia unicidad
        $cursoId = $this->route('curso');

        return [
            'codigo' => 'required|string|max:20|unique:cursos,codigo,' . $cursoId,
            'titulo' => 'required|string|max:150',
            'descripcion' => 'required|string|min:10',
            'precio' => 'required|numeric|min:0|max:999999.99', // Mitigación contra desbordes en DECIMAL(8,2)
            'duracion_horas' => 'required|integer|min:1|max:1000',
            'nivel' => 'required|in:Básico,Intermedio,Avanzado',
        ];
    }

    /**
     * Define los mensajes explícitos de error orientados al usuario final.
     * 
     * @return array
     */
    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del curso es obligatorio.',
            'codigo.unique' => 'Este código ya está en uso por otro curso activo o inactivo.',
            'titulo.required' => 'El título del curso es obligatorio.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres explícitos.',
            'precio.required' => 'Debe ingresar el precio de inversión del curso.',
            'precio.numeric' => 'El precio debe ser un valor numérico válido.',
            'precio.max' => 'El precio excede el límite financiero permitido por la base de datos.',
            'duracion_horas.required' => 'Debe especificar la duración en horas.',
            'nivel.in' => 'El nivel académico seleccionado no cumple el catálogo permitido.',
        ];
    }
}
