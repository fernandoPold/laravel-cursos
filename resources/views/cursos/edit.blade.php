@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<article>
    <header>
        <h3>Modificar Datos del Curso</h3>
        <p>Edite la información necesaria para actualizar el temario o alcance.</p>
    </header>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid">
            <label for="codigo">
                Código del Curso (*)
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $curso->codigo) }}" required>
                @error('codigo') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="titulo">
                Título del Curso (*)
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $curso->titulo) }}" required>
                @error('titulo') <small style="color: red;">{{ $message }}</small> @enderror
            </label>
        </div>

        <label for="descripcion">
            Descripción Detallada (*)
            <textarea id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
            @error('descripcion') <small style="color: red;">{{ $message }}</small> @enderror
        </label>

        <div class="grid">
            <label for="precio">
                Precio (S/.) (*)
                <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $curso->precio) }}" required>
                @error('precio') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="duracion_horas">
                Duración (Horas) (*)
                <input type="number" id="duracion_horas" name="duracion_horas" value="{{ old('duracion_horas', $curso->duracion_horas) }}" required>
                @error('duracion_horas') <small style="color: red;">{{ $message }}</small> @enderror
            </label>

            <label for="nivel">
                Nivel (*)
                <select id="nivel" name="nivel" required>
                    <option value="Básico" {{ old('nivel', $curso->nivel) == 'Básico' ? 'selected' : '' }}>Básico</option>
                    <option value="Intermedio" {{ old('nivel', $curso->nivel) == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option value="Avanzado" {{ old('nivel', $curso->nivel) == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                </select>
                @error('nivel') <small style="color: red;">{{ $message }}</small> @enderror
            </label>
        </div>

        <footer style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1rem;">
            <a href="{{ route('cursos.index') }}" class="secondary" role="button">Cancelar</a>
            <button type="submit">Actualizar Cambios</button>
        </footer>
    </form>
</article>
@endsection
