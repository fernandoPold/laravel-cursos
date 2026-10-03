@extends('layouts.app')

@section('title', 'Detalle del Curso')

@section('content')
<style>
    .detail-container {
        background-color: var(--pico-card-background-color) !important;
        border: 1px solid rgba(255, 255, 255, 0.05) !important;
        border-radius: 14px !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
        padding: 2.5rem !important;
    }
    .detail-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .detail-header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .detail-title {
        color: #f8fafc;
        font-weight: 700;
        margin: 0;
    }
    .detail-badge-container {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .detail-code {
        font-family: monospace;
        background-color: rgba(255, 255, 255, 0.06);
        padding: 0.25rem 0.6rem;
        border-radius: 6px;
        font-size: 0.9rem;
        color: #94a3b8;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .level-badge {
        font-size: 0.8rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        color: #fff;
    }
    .badge-basico { background-color: #2563eb; }
    .badge-intermedio { background-color: #d97706; }
    .badge-avanzado { background-color: #dc2626; }
    
    .detail-section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #a78bfa;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .detail-desc {
        color: #cbd5e1;
        line-height: 1.6;
        background-color: #11131e;
        padding: 1.25rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.03);
        margin-bottom: 2rem;
    }
    .info-grid-box {
        background-color: #11131e;
        padding: 1.25rem;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.03);
        text-align: center;
    }
    .info-grid-box strong {
        color: #94a3b8;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: block;
        margin-bottom: 0.5rem;
    }
    .info-grid-box p {
        color: #f1f5f9;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }
    .price-highlight {
        font-size: 1.4rem !important;
        color: #34d399 !important;
        font-weight: 700 !important;
    }
</style>

<article class="detail-container">
    <header class="detail-header" style="background: transparent; padding: 0; border-bottom: 1px solid rgba(255, 255, 255, 0.08);">
        <div class="detail-header-row">
            <div>
                <h3 class="detail-title"><i class="fa-solid fa-graduation-cap" style="color: var(--pico-primary);"></i> Hoja de Ruta del Curso</h3>
            </div>
            <div class="detail-badge-container">
                <span class="detail-code"><i class="fa-solid fa-hashtag"></i> {{ $curso->codigo }}</span>
                <span class="level-badge badge-{{ Str::slug($curso->nivel) }}">{{ $curso->nivel }}</span>
            </div>
        </div>
        <h2 style="color: #f1f5f9; margin-top: 1rem; margin-bottom: 0; font-weight: 600;">{{ $curso->titulo }}</h2>
    </header>

    <div class="detail-section-title">
        <i class="fa-solid fa-align-left"></i> Sumilla y Contenido Académico
    </div>
    <div class="detail-desc">
        {{ $curso->descripcion }}
    </div>

    <div class="grid" style="margin-bottom: 2rem; gap: 1.5rem;">
        <div class="info-grid-box">
            <strong>Duración Estimada</strong>
            <p><i class="fa-regular fa-clock" style="color: #a78bfa; margin-right: 0.25rem;"></i> {{ $curso->duracion_horas }} horas lectivas</p>
        </div>
        <div class="info-grid-box">
            <strong>Inversión Comercial</strong>
            <p class="price-highlight">S/ {{ number_format($curso->precio, 2) }}</p>
        </div>
        <div class="info-grid-box">
            <strong>Fecha de Registro</strong>
            <p><i class="fa-regular fa-calendar-days" style="color: #a78bfa; margin-right: 0.25rem;"></i> {{ $curso->created_at->format('d/m/Y') }}</p>
        </div>
    </div>

    <footer style="display: flex; justify-content: flex-start; background: transparent; padding: 0; border: none; margin-top: 1.5rem;">
        <a href="{{ route('cursos.index') }}" class="outline secondary" role="button" style="margin-bottom: 0; padding: 0.6rem 1.5rem; display: inline-flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-arrow-left"></i> Volver al Catálogo
        </a>
    </footer>
</article>
@endsection
