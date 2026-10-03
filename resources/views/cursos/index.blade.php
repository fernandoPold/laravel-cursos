@extends('layouts.app')

@section('title', 'Catálogo de Cursos')

@section('content')
<style>
    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 1rem;
    }
    .catalog-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        background: linear-gradient(90deg, #f8fafc, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 2.5rem;
        margin-bottom: 3rem;
    }
    .course-card {
        background-color: var(--pico-card-background-color) !important;
        border: 1px solid rgba(255, 255, 255, 0.06) !important;
        border-radius: 16px !important;
        overflow: hidden;
        padding: 0 !important;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25) !important;
    }
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(139, 92, 246, 0.25) !important;
        border-color: rgba(139, 92, 246, 0.4) !important;
    }
    
    /* Contenedor de Portada con Degradados Tecnológicos */
    .card-image-wrapper {
        position: relative;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .wrapper-basico { background: linear-gradient(135deg, #1e3a8a, #3b82f6); }
    .wrapper-intermedio { background: linear-gradient(135deg, #78350f, #d97706); }
    .wrapper-avanzado { background: linear-gradient(135deg, #7f1d1d, #dc2626); }

    .card-image-wrapper i {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.6);
        transition: transform 0.3s ease;
    }
    .course-card:hover .card-image-wrapper i {
        transform: scale(1.15) rotate(5deg);
        color: rgba(255, 255, 255, 0.9);
    }

    .card-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .course-code {
        font-family: 'Courier New', Courier, monospace;
        background-color: rgba(167, 139, 250, 0.1);
        padding: 0.2rem 0.6rem;
        border-radius: 6px;
        font-size: 0.8rem;
        color: #c084fc;
        font-weight: 600;
        border: 1px solid rgba(167, 139, 250, 0.15);
    }
    .level-badge {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .badge-basico { background-color: #2563eb; color: white; }
    .badge-intermedio { background-color: #d97706; color: white; }
    .badge-avanzado { background-color: #dc2626; color: white; }

    .course-title {
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #f8fafc;
        line-height: 1.3;
    }
    .course-desc {
        font-size: 0.9rem;
        color: #94a3b8;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
    }
    .card-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.06);
        margin-bottom: 1.5rem;
    }
    .course-duration {
        font-size: 0.85rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .course-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: #34d399;
        text-shadow: 0 2px 10px rgba(52, 211, 153, 0.2);
    }
    
    /* Botones de acción estilizados */
    .card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.75rem;
    }
    .btn-action {
        padding: 0.5rem 0.75rem !important;
        font-size: 0.85rem !important;
        font-weight: 600 !important;
        margin-bottom: 0 !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }
    .btn-view {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #f1f5f9 !important;
    }
    .btn-view:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }
    .btn-edit {
        background-color: transparent !important;
        border: 1px solid rgba(167, 139, 250, 0.4) !important;
        color: #c084fc !important;
    }
    .btn-edit:hover {
        background-color: rgba(167, 139, 250, 0.1) !important;
    }
    .btn-delete-container {
        grid-column: span 2;
    }
    .btn-delete {
        width: 100%;
        background-color: transparent !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
        color: #f87171 !important;
    }
    .btn-delete:hover {
        background-color: rgba(239, 68, 68, 0.15) !important;
        border-color: #ef4444 !important;
    }
</style>

<section>
    <div class="catalog-header">
        <h1>Catálogo de Cursos Ofertados</h1>
        <a href="{{ route('cursos.create') }}" class="btn-nuevo-curso" style="text-decoration: none;">
            <i class="fa-solid fa-plus"></i> Registrar Curso
        </a>
    </div>

    <div class="courses-grid">
        @foreach($cursos as $curso)
            <article class="course-card">
                <!-- Imagen Dinámica según el Nombre del Curso -->
                <div class="card-image-wrapper wrapper-{{ Str::slug($curso->nivel) }}">
                    @if($curso->nivel == 'Básico')
                        <i class="fa-solid fa-code"></i>
                    @elseif($curso->nivel == 'Intermedio')
                        <i class="fa-solid fa-laptop-code"></i>
                    @else
                        <i class="fa-solid fa-terminal"></i>
                    @endif
                </div>
                
                <div class="card-body">
                    <div class="card-meta">
                        <span class="course-code"><i class="fa-solid fa-hashtag"></i> {{ $curso->codigo }}</span>
                        <span class="level-badge badge-{{ Str::slug($curso->nivel) }}">{{ $curso->nivel }}</span>
                    </div>
                    
                    <h3 class="course-title">{{ $curso->titulo }}</h3>
                    <p class="course-desc">{{ $curso->descripcion }}</p>
                    
                    <div class="card-info-row">
                        <div class="course-duration">
                            <i class="fa-regular fa-clock" style="color: #a78bfa;"></i> 
                            <span>{{ $curso->duracion_horas }} horas lectivas</span>
                        </div>
                        <div class="course-price">
                            S/ {{ number_format($curso->precio, 2) }}
                        </div>
                    </div>
                    
                    <div class="card-actions">
                        <a href="{{ route('cursos.show', $curso->id) }}" class="btn-action btn-view" role="button">
                            <i class="fa-solid fa-eye"></i> Ver
                        </a>
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn-action btn-edit" role="button">
                            <i class="fa-solid fa-pen-to-square"></i> Editar
                        </a>
                        
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="btn-delete-container" onsubmit="return confirm('¿Está seguro de que desea eliminar permanentemente este programa académico?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
                                <i class="fa-regular fa-trash-can"></i> Eliminar Curso
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
