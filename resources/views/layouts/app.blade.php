<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Alcaldía Almirante Padilla') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Estilos adicionales -->
    @stack('styles')
</head>
<body class="site-body">
    <!-- Barra de navegación pública -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-wrapper">
                <!-- Logo -->
                <div class="navbar-left">
                    <a href="{{ route('home') }}" class="logo">
                        Alcaldía Almirante Padilla
                    </a>
                </div>

                <!-- Botón hamburguesa -->
                <button class="hamburger-btn" id="hamburgerBtn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <!-- Menú de navegación -->
                <div class="nav-menu" id="navMenu">
                    <a href="{{ route('home') }}" class="nav-link">Inicio</a>
                    <a href="#" class="nav-link">Nuestra Historia</a>

                    <!-- Dropdown Categorías -->
                    <div class="dropdown" x-data="{ open: false }">
                        <button @click="open = !open" class="dropdown-trigger nav-link">
                            Categorías
                            <svg class="dropdown-icon" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                        <div class="dropdown-menu" x-show="open" x-cloak>
                            @php
                                use App\Models\Category;
                                $categories = Category::all();
                            @endphp
                            @foreach($categories as $category)
                                <a href="{{ route('category.articles', $category) }}" class="dropdown-item">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <a href="#" class="nav-link">Contacto</a>

                    <!-- ===== BOTONES DE USUARIO PARA MÓVIL (DENTRO DEL MENÚ) ===== -->
                    <div class="mobile-user-buttons">
                        @auth
                            <a href="{{ route('admin.articles.index') }}" class="nav-link mobile-admin-link">Admin</a>
                            <form method="POST" action="{{ route('logout') }}" class="mobile-logout-form">
                                @csrf
                                <button type="submit" class="nav-link mobile-logout-btn">Salir</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="nav-link mobile-login-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-link mobile-register-link">Registro</a>
                        @endauth
                    </div>
                </div>
                
                <!-- Botones de usuario escritorio (se mantienen) -->
                <div class="navbar-right desktop-only">
                    @auth
                        <a href="{{ route('admin.articles.index') }}" class="admin-link">Admin</a>
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">Salir</button>
                        </form>
                    @else
                        <!-- tus botones -->
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Overlay para móvil -->
    <div class="menu-overlay" id="menuOverlay"></div>

    <div class="eslogan">
        <h1 class="logan">¡Juntos Transformamos Nuestro Municipio!</h1>
    </div>

    <!-- Contenido principal -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-container">
            © {{ date('Y') }} Alcaldía del Municipio Almirante Padilla. Todos los derechos reservados.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>