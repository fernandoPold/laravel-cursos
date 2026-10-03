<!DOCTYPE html>
<html lang="es" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plataforma de Cursos')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    <style>
        body { padding-top: 1rem; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 1rem; border-radius: 6px; margin-bottom: 1rem; }
        .badge { display: inline-block; padding: 0.25em 0.6em; font-size: 80%; font-weight: 700; border-radius: 10rem; color: #fff; background-color: #10b981; }
        nav { margin-bottom: 2rem; }
    </style>
</head>
<body>
    <main class="container">
        <nav>
            <ul>
                <li><strong>🎓 Sistema de Gestión de Cursos</strong></li>
            </ul>
            <ul>
                <li><a href="{{ route('cursos.index') }}" class="secondary">Catálogo de Cursos</a></li>
                <li><a href="{{ route('cursos.create') }}" class="contrast">+ Nuevo Curso</a></li>
            </ul>
        </nav>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->has('error_negocio'))
            <div class="alert-danger">
                {{ $errors->first('error_negocio') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
