@extends('layouts.app')

@section('title', 'Editar Curso')

@section('content')
<style>
    .form-container {
        background-color: var(--pico-card-background-color) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-radius: 14px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
        padding: 2.5rem !important;
    }
    .form-header h3 {
        color: #f8fafc;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .form-header p {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }
    label {
        color: #cbd5e1 !important;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }
    input, textarea, select {
        background-color: #11131e !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #f1f5f9 !important;
        border-radius: 8px !important;
        transition: border-color 0.2s ease, box-shadow 0.2s ease !important;
    }
    input:focus, textarea:focus, select:focus {
        border-color: var(--pico-primary) !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2) !important;
    }
    .field-icon {
        color: #a78bfa;
        margin-right: 0.4rem;
    }
    .error-msg {
        color: #f87171;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        display: block;
    }
</style>

<article class="form-container">
    <header class="form-header" style="background: transparent; padding: 0; border: none;">
        <h3><i class="fa-solid fa-pen-to-square" style="color: var(--pico-primary);"></i> Modificar Datos del Programa Académico</h3>
        <p>Actualice los metadatos necesarios. Los cambios se validarán por la capa de servicio para mantener la integridad.</p>
    </header>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid">
            <label for="codigo">
                <i class="fa-solid fa-barcode field-icon"></i> Código del Curso <span style="color: var(--pico-primary);">*</span>
                <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $curso->codigo) }}" required>
                @error('codigo') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </label>

            <label for="titulo">
                <i class="fa-solid fa-book field-icon"></i> Título del Curso <span style="color: var(--pico-primary);">*</span>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $curso->titulo) }}" required>
                @error('titulo') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </label>
        </div>

        <label for="descripcion">
            <i class="fa-solid fa-align-left field-icon"></i> Sumilla / Descripción Detallada <span style="color: var(--pico-primary);">*</span>
            <textarea id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $curso->descripcion) }}</textarea>
            @error('descripcion') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
        </label>

        <div class="grid">
            <label for="precio">
                <i class="fa-solid fa-money-bill-wave field-icon"></i> Inversión (S/.) <span style="color: var(--pico-primary);">*</span>
                <input type="number" step="0.01" id="precio" name="precio" value="{{ old('precio', $curso->precio) }}" required>
                @error('precio') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </label>

            <label for="duracion_horas">
                <i class="fa-regular fa-clock field-icon"></i> Duración Cronológica (Horas) <span style="color: var(--pico-primary);">*</span>
                <input type="number" id="duracion_horas" name="duracion_horas" value="{{ old('duracion_horas', $curso->duracion_horas) }}" required>
                @error('duracion_horas') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </label>

            <label for="nivel">
                <i class="fa-solid fa-chart-line field-icon"></i> Nivel Académico <span style="color: var(--pico-primary);">*</span>
                <select id="nivel" name="nivel" required>
                    <option value="Básico" {{ old('nivel', $curso->nivel) == 'Básico' ? 'selected' : '' }}>Básico</option>
                    <option value="Intermedio" {{ old('nivel', $curso->nivel) == 'Intermedio' ? 'selected' : '' }}>Intermedio</option>
                    <option value="Avanzado" {{ old('nivel', $curso->nivel) == 'Avanzado' ? 'selected' : '' }}>Avanzado</option>
                </select>
                @error('nivel') <span class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</span> @enderror
            </label>
        </div>

        <footer style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; background: transparent; padding: 0; border: none;">
            <a href="{{ route('cursos.index') }}" class="secondary outline" role="button" style="margin-bottom: 0; padding: 0.6rem 1.5rem;">
                <i class="fa-solid fa-arrow-left"></i> Cancelar
            </a>
            <button type="submit" style="background-color: var(--pico-primary); border: none; margin-bottom: 0; padding: 0.6rem 2rem;">
                <i class="fa-solid fa-rotate"></i> Actualizar Cambios
            </button>
        </footer>
    </form>
</article>
@endsection
