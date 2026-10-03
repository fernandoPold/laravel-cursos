@extends('layouts.app')

@section('title', 'Catálogo de Cursos')

@section('content')
<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Catálogo de Cursos Registrados</h2>
        <a href="{{ route('cursos.create') }}" role="button">+ Registrar Curso</a>
    </div>

    @if($cursos->isEmpty())
        <article>
            <p style="text-align: center; color: #666;">No hay cursos registrados en este momento. Haz clic en <strong>+ Registrar Curso</strong> para agregar uno nuevo.</p>
        </article>
    @else
        <figure>
            <table role="grid">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Nivel</th>
                        <th>Duración</th>
                        <th>Precio</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cursos as $curso)
                        <tr>
                            <td><code>{{ $curso->codigo }}</code></td>
                            <td><strong>{{ $curso->titulo }}</strong></td>
                            <td><span class="badge">{{ $curso->nivel }}</span></td>
                            <td>{{ $curso->duracion_horas }} horas</td>
                            <td>S/ {{ number_format($curso->precio, 2) }}</td>
                            <td>
                                <a href="{{ route('cursos.show', $curso->id) }}" class="outline" role="button" style="padding: 0.2rem 0.6rem; font-size: 0.85rem;">Ver Detalle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </figure>
    @endif
</section>
@endsection
