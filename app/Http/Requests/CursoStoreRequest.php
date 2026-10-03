<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cursoId = $this->route('curso'); 

        return [
            'codigo' => 'required|string|max:20|unique:cursos,codigo,' . $cursoId,
            'titulo' => 'required|string|max:150',
            'descripcion' => 'required|string|min:10',
            'precio' => 'required|numeric|min:0',
            'duracion_horas' => 'required|integer|min:1',
            'nivel' => 'required|in:Básico,Intermedio,Avanzado',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required' => 'El código del curso es obligatorio.',
            'codigo.unique' => 'Este código ya está en uso por otro curso.',
            'titulo.required' => 'El título del curso es obligatorio.',
            'descripcion.min' => 'La descripción debe tener al menos 10 caracteres.',
            'precio.required' => 'Debe ingresar el precio del curso.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'duracion_horas.required' => 'Debe especificar la duración en horas.',
            'nivel.in' => 'El nivel seleccionado no es válido.',
        ];
    }
}
