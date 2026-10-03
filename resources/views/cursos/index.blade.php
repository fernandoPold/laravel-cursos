@extends('layouts.app')

@section('title', 'Catálogo de Cursos')

@section('content')
<style>
    /* Estilos avanzados para las tarjetas del catálogo */
    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .catalog-header h2 {
        margin: 0;
        font-weight: 700;
        color: #f1f5f9;
    }
    .courses-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    .course-card {
        background-color: var(--pico-card-background-color) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-radius: 14px !important;
        overflow: hidden;
        padding: 0 !important;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s ease !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1) !important;
    }
    .course-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px -4px rgba(0, 0, 0, 0.4), 0 4px 12px -2px rgba(139, 92, 246, 0.15) !important;
        border-color: rgba(139, 92, 246, 0.3) !important;
    }
    .card-banner {
        height: 8px;
        width: 100%;
    }
    .banner-basico { background: linear-gradient(90deg, #3b82f6, #60a5fa); }
    .banner-intermedio { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .banner-avanzado { background: linear-gradient(90deg, #ef4444, #f87171); }

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
        margin-bottom: 0.75rem;
    }
    .course-code {
        font-family: monospace;
        background-color: rgba(255, 255, 255, 0.06);
        padding: 0.15rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        color: #94a3b8;
    }
    .level-badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 20px;
        color: #fff;
    }
    .badge-basico { background-color: #2563eb; }
    .badge-intermedio { background-color: #d97706; }
    .badge-avanzado { background-color: #dc2626; }

    .course-title {
        font-size: 1.25rem;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 0.75rem;
        color: #f8fafc;
    }
    .course-desc {
        font-size: 0.9rem;
        color: #94a3b8;
        line-height: 1.5;
        margin-bottom: 1.25rem;
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
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 1.25rem;
    }
    .course-duration {
        font-size: 0.85rem;
        color: #cbd5e1;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .course-price {
        font-size: 1.3rem;
        font-weight: 700;
        color: #34d399; /* Verde esmeralda brillante */
    }
    .card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }
    .card-actions .btn-action {
        padding: 0.4rem 0.5rem !important;
        font-size: 0.8rem !important;
        margin-bottom: 0 !important;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.3rem;
        border-radius: 6px !important;
    }
    .btn-delete-container {
        grid-column: span 2;
        margin-top: 0.25rem;
    }
    .btn-delete-container button {
        width: 100%;
        background-color: transparent !important;
        border: 1px solid rgba(239, 68, 68, 0.4) !important;
        color: #f87171 !important;
    }
    .btn-delete-container button:hover {
        background-color: rgba(239, 68, 68, 0.1) !important;
    }
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
        background-color: var(--pico-card-background-color);
        border-radius: 14px;
        border: 1px dashed rgba(255, 255, 255, 0.1);
    }
</style>

<section>
    <div class="catalog-header">
        <h2>Catálogo de Cursos Ofertados</h2>
        <a href="{{ route('cursos.create') }}" role="button" style="background-color: var(--pico-primary); border: none; padding: 0.5rem 1.2rem; border-radius: 8px;">
            <i class="fa-solid fa-plus"></i> Registrar Curso
        </a>
    </div>

    @if($cursos->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: #475569; margin-bottom: 1rem; display: block;"></i>
            <p style="color: #94a3b8; font-size: 1.05rem;">No hay programas académicos registrados en este momento.</p>
            <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1.5rem;">Crea un nuevo curso para nutrir la vitrina del catálogo.</p>
            <a href="{{ route('cursos.create') }}" class="outline" role="button" style="display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; padding: 0.4rem 1rem;">
                <i class="fa-solid fa-sparkles"></i> Agregar primer curso
            </a>
        </div>
    @else
        <div class="courses-grid">
            @foreach($cursos as $curso)
                <article class="course-card">
                    <!-- Banner de color según el nivel -->
                    <div class="card-banner banner-{{ Str::slug($curso->nivel) }}"></div>
                    
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
                                <span>{{ $curso->duracion_horas }} h lectivas</span>
                            </div>
                            <div class="course-price">
                                S/ {{ number_format($curso->precio, 2) }}
                            </div>
                        </div>
                        
                        <div class="card-actions">
                            <a href="{{ route('cursos.show', $curso->id) }}" class="outline btn-action" role="button">
                                <i class="fa-solid fa-eye"></i> Detalle
                            </a>
                            <a href="{{ route('cursos.edit', $curso->id) }}" class="outline secondary btn-action" role="button">
                                <i class="fa-solid fa-pen-to-square"></i> Editar
                            </a>
                            
                            <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="btn-delete-container" onsubmit="return confirm('¿Está seguro de que desea eliminar permanentemente este programa del catálogo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="outline btn-action">
                                    <i class="fa-regular fa-trash-can"></i> Eliminar Curso
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection
