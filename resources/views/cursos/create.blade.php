@extends('layouts.app')

@section('title', 'Registrar Nuevo Curso')

@section('content')
<article>
    <header>
        <h3>Registrar Nuevo Curso</h3>
        <p>Complete los datos requeridos. Los campos validados por la capa de servicio garantizan la integridad de los datos.</p>
    </header>

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <div class="grid">
            <label for="codigo">
                Código del Curso (*)
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo') }}" placeholder="EJ: CUR-101" required>
                @error('codigo') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="titulo">
                Título del Curso (*)
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" placeholder="Ej: Laravel Avanzado y Arquitectura" required>
                @error('titulo') <small style="color: red;">{{ $message }}</small> @enderror
            </label>
        </div>

        <label for="descripcion">
            Descripción Detallada (*)
            <textarea id="descripcion" name="descripcion" rows="3" placeholder="Ingrese el temario y alcance del curso..." required>{{ old('descripcion') }}</textarea>
            @error('descripcion') <small style="color: red;">{{ $message }}</small> @enderror
        </label>

        <div class="grid">
            <label for="precio">
                Precio (S/.) (*)
                <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio') }}" placeholder="199.90" required>
                @error('precio') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="duracion_horas">
                Duración (Horas) (*)
                <input type="number" id="duracion_horas" name="duracion_horas" value="{{ old('duracion_horas') }}" placeholder="40" required>
                @error('duracion_horas') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="nivel">
                Nivel (*)
                <select id="nivel" name="nivel" required>
                    <option value="" disabled {{ old('nivel') ? '' : 'selected' }}>Seleccione nivel</option>
                    <option value="Básico" {{ old('nivel') == 'Básico' ? 'selected' : '' }}>Básico</option>
                    <option value="Intermedio" {{ old('nivel') == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option value="Avanzado" {{ old('nivel') == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                </select>
                @error('nivel') <small style="color: red;">{{ $message }}</small> @enderror
            </label>
        </div>

        <footer style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;">
            <a href="{{ route('cursos.index') }}" class="secondary" role="button">Cancelar</a>
            <button type="submit">Guardar Curso</button>
        </footer>
    </form>
</article>
@endsection
