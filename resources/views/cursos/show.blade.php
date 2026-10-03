@extends('layouts.app')

@section('title', 'Detalle del Curso')

@section('content')
<article>
    <header>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3>{{ $curso->titulo }}</h3>
            <span class="badge">{{ $curso->nivel }}</span>
        </div>
        <p>Código de identificación: <code>{{ $curso->codigo }}</code></p>
    </header>

    <p><strong>Descripción:</strong></p>
    <p>{{ $curso->descripcion }}</p>

    <div class="grid" style="margin-top: 1.5rem;">
        <div>
            <strong>Duración estimada:</strong>
            <p>{{ $curso->duracion_horas }} horas lectivas</p>
        </div>
        <div>
            <strong>Inversión:</strong>
            <p style="font-size: 1.25rem; color: #10b981; font-weight: bold;">S/ {{ number_format($curso->precio, 2) }}</p>
        </div>
        <div>
            <strong>Fecha de Registro:</strong>
            <p>{{ $curso->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <footer>
        <a href="{{ route('cursos.index') }}" class="outline" role="button">← Volver al Catálogo</a>
    </footer>
</article>
@endsection
