@php
    use Illuminate\Support\Facades\Auth;
@endphp
    <!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Diseño Change.org Admin - Bootstrap</title>
    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />


</head>

<body>
<div class="sidebar">
    <div class="sidebar-logo">
        Change.org Admin
    </div>

    <div class="user-panel">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=fff&color=ff3030" alt="User">
        <div class="d-flex flex-column text-truncate">
            <span class="fw-bold">{{ Auth::user()->name }}</span>
            <small style="opacity: 0.8; font-size: 0.75rem;">Administrador</small>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li class="menu-header">Gestión Principal</li>

        <li>
            <a href="{{route('admin.home')}}" class="{{ request()->is('admin') || request()->is('admin/petitions*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-signature me-2"></i>Peticiones
            </a>
        </li>

        <li>
            <a href="{{route('admin.categories')}}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group me-2"></i>Categorias
            </a>
        </li>
        <li>
            <a href="#" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <i class="fa-solid fa-user me-2"></i>Usuarios
            </a>
        </li>

        <li class="menu-header">Sistema</li>
        <li>
            <a href="{{ url('/') }}" target="_blank">
                <i class="fa fa-external-link-alt me-2"></i> Ver Web Pública
            </a>
        </li>
    </ul>
</div>
<div class="main-wrapper">

    <header class="top-navbar">
        <div class="search-bar d-none d-md-block">
            <input type="text" placeholder="Buscar en panel...">
        </div>

        <div class="top-icons d-flex align-items-center ms-auto">
            <div class="position-relative">
                <i class="fa fa-bell"></i>
                <span class="badge bg-danger badge-notification">3</span>
            </div>

            <div class="dropdown ms-4">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" alt="" width="32" height="32" class="rounded-circle me-2">
                    <span class="d-none d-sm-inline fw-bold">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser1">
                    <li><h6 class="dropdown-header">Hola, {{ Auth::user()->name }}</h6></li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user me-2"></i> Mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="content-container">
        @yield('content')
    </div>

    <footer class="bg-white text-center py-3 text-muted mt-auto border-top">
        <small>&copy; {{ date('Y') }} Change.org Clon - Panel de Control.</small>
    </footer>

</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>
