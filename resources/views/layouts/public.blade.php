@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El cambio comienza aqui - Change.org</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{asset("css/styles.css")}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

</head>

<body>
<!--Header-->
<nav class="navbar navbar-expand-lg bg-white overflow-hidden border-bottom border-1 py-2">
    <div class="container d-flex align-items-center px-lg-5 px-4">

        <a href="" class="navbar-brand p-0">
            <img width="125" src="{{asset("images/Change.org_logo.svg.png")}}" alt="Logo change org">
        </a>

        <div class="ms-4 d-none d-lg-flex flex-grow-1">
            <ul class="navbar-nav d-flex align-items-center gap-4">
                <li class="nav-item py-1 px-2 rounded-3">
                    <a class="nav-link fw-bold p-0" href="#">Mis peticiones</a>
                </li>
                <li class="nav-item py-1 px-2 rounded-3">
                    <a class="nav-link fw-bold p-0" href="#">Programa de socios/as</a>
                </li>
                <li class="nav-item py-1 px-2 rounded-3">
                    <a class="nav-link fw-bold p-0 d-flex align-items-center gap-1" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="#413a4a" stroke-width="3">
                            <path d="m21 21-4.34-4.34"></path>
                            <circle cx="11" cy="11" r="8"></circle>
                        </svg>
                        Buscar
                    </a>
                </li>
            </ul>
        </div>

        <div class="d-flex align-items-center gap-4">
            <button class="btn btn-outline-secondary p-075 px-3 fw-bold">Inicia una peticion</button>
            <img id="profileImg" src="https://static.change.org/ds-v2/avatar-sunshine.svg"
                 class="d-none d-lg-inline-block" alt="" width="35">
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu"
                aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </div>

    <div class="collapse d-lg-none w-100" id="mobileMenu">
        <div class="px-3 mt-3 d-flex flex-column w-100 gap-3">
            <p class="fw-bold mb-1">Saul Romero</p>
            <span>Mis peticiones</span>
            <span>Programa de socio/as</span>
            <span>Buscar</span>
            <span>Ajustes</span>
            <div class="divisor-solid w-100"></div>
            <span class="mb-3">Salir</span>
        </div>
    </div>
</nav>

    @yield('content')

<!--Footer-->
<footer class="w-100 border-top border-1 border-gray ">
    <div class="container d-flex flex-column py-5 px-4">
        <div class="d-flex justify-content-between flex-wrap" style="row-gap: 20px;">
            <div class=" d-flex flex-column gap-2">
                <h6 class="fw-bold mb-2">Acerca de</h6>
                <a class="text-decoration-none" href="">Sobre Change.org</a>
                <a class="text-decoration-none" href="">Impacto</a>
                <a class="text-decoration-none" href="">Empleo</a>
                <a class="text-decoration-none" href="">Equipo</a>
            </div>
            <div class="d-flex flex-column gap-2">
                <h6 class="fw-bold mb-2">Comunidad</h6>
                <a class="text-decoration-none" href="">Prensa</a>
                <a class="text-decoration-none" href="">Normas de la Comunidad</a>
            </div>
            <div class="d-flex flex-column gap-2">
                <h6 class="fw-bold mb-2">Ayuda</h6>
                <a class="text-decoration-none" href="">Ayuda</a>
                <a class="text-decoration-none" href="">Guías</a>
                <a class="text-decoration-none" href="">Privacidad</a>
                <a class="text-decoration-none" href="">Terminos</a>
                <a class="text-decoration-none" href="">Declaacion de accesibilidad</a>
                <a class="text-decoration-none" href="">Politica de cookies</a>
                <a class="text-decoration-none" href="">Gestionar cookies</a>

            </div>
            <div class="d-flex flex-column gap-2">
                <h6 class="fw-bold mb-2">Redes sociales</h6>
                <a class="text-decoration-none" href="">X</a>
                <a class="text-decoration-none" href="">Facebook</a>
                <a class="text-decoration-none" href="">Instagram</a>
                <a class="text-decoration-none" href="">Tiktok</a>
            </div>
        </div>
        <select class="form-select w-100 border-gray d-inline-block d-lg-none mt-5"
                aria-label="Default select example">
            <option selected>Español (España)</option>
            <option value="1">English</option>
            <option value="2">Deutsch</option>
            <option value="3">Français</option>
        </select>
        <div class="divisor-solid mt-5"></div>
        <div class="w-100 d-flex justify-content-between mt-5">
            <div>
                <span class="fs-8 fw-bold">© 2025, Change.org, PBC</span><br>
                <span class="fs-8">Esta web está protegida por reCAPTCHA y por Google
                        Política de privacidad
                        y
                        Normas de uso
                        .</span>
            </div>
            <select class="form-select w-max border-gray d-none d-lg-inline-block"
                    aria-label="Default select example">
                <option selected>Español (España)</option>
                <option value="1">English</option>
                <option value="2">Deutsch</option>
                <option value="3">Français</option>
            </select>
        </div>
    </div>
</footer>
</body>

</html>
