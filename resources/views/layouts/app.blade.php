<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plataforma de Cursos')</title>
    <!-- Pico CSS v2 -->
    <link rel="stylesheet" href="https://jsdelivr.net">
    <!-- FontAwesome para Iconos Modernos -->
    <link rel="stylesheet" href="https://cloudflare.com">
    
    <style>
        :root {
            --pico-background-color: #0f111a; /* Fondo oscuro profundo */
            --pico-color: #e2e8f0;
            --pico-primary: #8b5cf6; /* Violeta eléctrico */
            --pico-primary-hover: #7c3aed;
            --pico-card-background-color: #1a1d29; /* Fondo de tarjetas */
        }
        
        body { 
            padding-top: 1.5rem;
            background-color: var(--pico-background-color);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        /* Alertas Estilizadas */
        .alert-success { 
            background-color: rgba(16, 185, 129, 0.15); 
            color: #34d399; 
            border: 1px solid rgba(16, 185, 129, 0.3); 
            padding: 1rem; 
            border-radius: 8px; 
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .alert-danger { 
            background-color: rgba(239, 68, 68, 0.15); 
            color: #f87171; 
            border: 1px solid rgba(239, 68, 68, 0.3); 
            padding: 1rem; 
            border-radius: 8px; 
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Barra de Navegación Premium */
        nav { 
            background-color: #161925;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        nav a {
            transition: transform 0.2s ease, color 0.2s ease;
        }
        nav a:hover {
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <main class="container">
        <!-- Barra de Navegación -->
        <nav>
            <ul>
                <li>
                    <strong style="color: #a78bfa; font-size: 1.2rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-graduation-cap"></i> EduStream Admin
                    </strong>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ route('cursos.index') }}" class="secondary" style="display: flex; align-items: center; gap: 0.4rem;">
                        <i class="fa-solid fa-layer-group"></i> Catálogo
                    </a>
                </li>
                <li>
                    <a href="{{ route('cursos.create') }}" class="contrast" style="background-color: var(--pico-primary); border: none; padding: 0.4rem 1rem; border-radius: 6px; display: flex; align-items: center; gap: 0.4rem; color: white;">
                        <i class="fa-solid fa-plus"></i> Nuevo Curso
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Mensajes de Notificación de Capas -->
        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->has('error_negocio'))
            <div class="alert-danger">
                <i class="fa-solid fa-triangle-exclamation"></i> {{ $errors->first('error_negocio') }}
            </div>
        @endif

        <!-- Espacio Dinámico para el Contenido -->
        @yield('content')
    </main>
</body>
</html>