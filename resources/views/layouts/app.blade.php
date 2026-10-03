<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EduStream - Premium LMS')</title>
    <!-- Pico CSS v2 -->
    <link rel="stylesheet" href="https://jsdelivr.net">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cloudflare.com">
    
    <style>
        :root {
            --pico-background-color: #0b0f19; /* Ultra oscuro */
            --pico-color: #f1f5f9;
            --pico-primary: #8b5cf6; 
            --pico-primary-hover: #7c3aed;
            --pico-card-background-color: #111827; 
        }
        
        body { 
            padding-top: 1.5rem;
            background-color: var(--pico-background-color);
            font-family: 'Segoe UI', system-ui, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-container {
            flex: 1;
        }

        /* Notificaciones */
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

        /* Barra de Navegación Profesional Sin Viñetas */
        .premium-nav { 
            background: linear-gradient(145deg, #1f2937, #111827);
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo {
            color: #a78bfa !important; 
            font-size: 1.4rem !important; 
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .nav-links li {
            padding: 0;
            margin: 0;
        }
        .link-catalogo {
            color: #cbd5e1 !important;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
        .link-catalogo:hover {
            color: #a78bfa !important;
        }
        .btn-nuevo-curso {
            background-color: var(--pico-primary) !important; 
            border: none !important; 
            padding: 0.5rem 1.2rem !important; 
            border-radius: 8px !important; 
            color: white !important;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            transition: all 0.2s ease !important;
        }
        .btn-nuevo-curso:hover {
            background-color: var(--pico-primary-hover) !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(139, 92, 246, 0.4);
        }

        /* Footer Institucional */
        footer.premium-footer {
            background-color: #0f172a;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1.5rem 0;
            margin-top: 4rem;
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <main class="container main-container">
        <!-- Barra de Navegación Reestructurada limpia -->
        <div class="premium-nav">
            <a href="{{ route('cursos.index') }}" class="nav-logo">
                <i class="fa-solid fa-graduation-cap"></i> EduStream
            </a>
            <ul class="nav-links">
                <li>
                    <a href="{{ route('cursos.index') }}" class="link-catalogo">
                        <i class="fa-solid fa-layer-group"></i> Catálogo
                    </a>
                </li>
                <li>
                    <a href="{{ route('cursos.create') }}" class="btn-nuevo-curso">
                        <i class="fa-solid fa-plus"></i> Nuevo Curso
                    </a>
                </li>
            </ul>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer Añadido para Rúbrica UI -->
    <footer class="premium-footer">
        <div class="container">
            <p style="margin: 0;">&copy; {{ date('Y') }} <strong>EduStream LMS</strong>. Todos los derechos reservados. | Módulo de Gestión Académica Especializada.</p>
        </div>
    </footer>
</body>
</html>
