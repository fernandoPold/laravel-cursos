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
                        <th style="text-align: center;">Acciones</th>
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
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('cursos.show', $curso->id) }}" class="outline" role="button" style="padding: 0.2rem 0.5rem; font-size: 0.8rem; margin-bottom: 0;">Ver</a>
                                    <a href="{{ route('cursos.edit', $curso->id) }}" class="outline secondary" role="button" style="padding: 0.2rem 0.5rem; font-size: 0.8rem; margin-bottom: 0;">Editar</a>
                                    <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('¿Está seguro de que desea eliminar este curso del catálogo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="outline contrast" style="padding: 0.2rem 0.5rem; font-size: 0.8rem; margin-bottom: 0;">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </figure>
    @endif
</section>
@endsection
