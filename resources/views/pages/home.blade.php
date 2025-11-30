@extends('layouts.public')

@section('content')
    <!--Hero-->
    <section class="hero container py-5 px-lg-5 px-4 position-relative text-center">
        <img class="globe-bg" src="https://static.change.org/homepageV3/background-globe-sunrise.svg" alt="">
        <div id="fcard1" class="floating-card d-none d-lg-flex flex-column position-absolute">
            <img src="images/card1.jpg" class="rounded-circle" alt="Imagen del chicas con cajas">
            <div class="floating-card-content rounded-pill py-2 d-flex flex-column w-100">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="dot"></div>
                    <span class="fs-5 fw-medium">¡Victoria!</span>
                </div>
                <span>157.929 firmas</span>
            </div>
            <span class="pt-3 fs-6 ">Logra que financien la medicación para cáncer de mama
                metastásico</span>
        </div>

        <div id="fcard2" class="floating-card  d-none d-lg-flex flex-column position-absolute">
            <img src="images/card2.jpg" class="rounded-circle" alt="Imagen del chicas con cajas">
            <div class="floating-card-content rounded-pill py-2 d-flex flex-column w-100">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="dot"></div>
                    <span class="fs-5 fw-medium">¡Victoria!</span>
                </div>
                <span>162.845 firmas</span>
            </div>
            <span class="pt-3 fs-6 ">Familiares de víctimas de la DANA logran comisión de investigación</span>
        </div>

        <div id="fcard3" class="floating-card d-none d-lg-flex flex-column position-absolute">
            <img src="images/card3.jpg" class="rounded-circle" alt="Imagen del chicas con cajas">
            <div class="floating-card-content rounded-pill py-2 d-flex flex-column w-100">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="dot"></div>
                    <span class="fs-5 fw-medium">¡Victoria!</span>
                </div>
                <span>141.336 firmas</span>
            </div>
            <span class="pt-3 fs-6 ">Su hija tiene Anorexia y logra que abran en el País Vasco una Unidad de...</span>
        </div>

        <div id="fcard4" class="floating-card  d-none d-lg-flex flex-column position-absolute">
            <img src="images/card4.jpg" class="rounded-circle" alt="Imagen del chicas con cajas">
            <div class="floating-card-content rounded-pill py-2 d-flex flex-column w-100">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="dot"></div>
                    <span class="fs-5 fw-medium">¡Victoria!</span>
                </div>
                <span>96.240 firmas</span>
            </div>
            <span class="pt-3 fs-6 ">Consigue que no separen a sus padres con Alzheimer: llevan más d...</span>
        </div>

        <div id="fcard5" class="floating-card  d-none d-lg-flex d-flex flex-column position-absolute">
            <img src="images/card5.jpg" class="rounded-circle" alt="Imagen del chicas con cajas">
            <div class="floating-card-content rounded-pill py-2 d-flex flex-column w-100">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="dot"></div>
                    <span class="fs-5 fw-medium">En tendencia</span>
                </div>
                <span>192.214 firmas</span>
            </div>
            <span class="pt-3 fs-6 ">No podemos más. Stop guardias médicas de 24 horas - Consigue el...</span>
        </div>

        <div class="hero-content mt-lg-4 mt-1">
            <h1 class="fs-1">El cambio <br> comienza aquí <span style="color: #bd1e19 !important">.</span> </h1>
            <h2 class="mx-auto mt-3">Únete a <span class="fw-bold">567.908.560</span> personas que están impulsando
                un
                cambio real en sus
                comunidades.
            </h2>
            <div class="d-flex flex-md-row flex-column  justify-content-center gap-4 mt-4">
                <button class="btn btn-primary fs-5 fw-bold px-3 p-075">Crear una petición</button>
                <button class="btn btn-outline-secondary fw-bold px-3 p-075 fs-5">Comenzar con IA</button>
            </div>
        </div>
    </section>

    <!--Pasos-->
    <section class="pasos container-fluid bg-secondary py-5 px-4 mt-5">
        <div class="d-flex flex-column align-items-center w-auto">
            <h3 class="m-0 fw-bold fs-2 text-center">Usar la plataforma de peticiones n.º 1 del mundo es fácil</h3>
            <div class="d-flex flex-column flex-lg-row w-70 mt-4 gap-4 gap-md-0">
                <div class="step-card d-flex flex-column align-items-center justify-content-center">
                    <div class="number bg-blue rounded-circle text-center">
                        <span class="fs-5 text-white my-auto fw-semibold">1</span>
                    </div>
                    <span class="fw-semibold mt-2">Crea una petición en dos minutos</span>
                    <span>Mas de 2.000 nuevas cada día</span>
                </div>
                <div class="divider"></div>
                <div class="step-card d-flex flex-column align-items-center justify-content-center">
                    <div class="number bg-blue rounded-circle text-center">
                        <span class="fs-5 text-white my-auto fw-semibold">2</span>
                    </div>
                    <span class="fw-semibold mt-2">Consigue apoyo gracias a nuestra gran comunidad</span>
                    <span>Más de 500.000 firmas diarias</span>
                </div>
                <div class="divider"></div>
                <div class="step-card d-flex flex-column align-items-center justify-content-center">
                    <div class="number bg-blue rounded-circle text-center">
                        <span class="fs-5 text-white my-auto fw-semibold">3</span>
                    </div>
                    <span class="fw-semibold mt-2">Llega hasta los responsables gracias a nuestra red</span>
                    <span>Más de 1.000 notificados a diario</span>
                </div>
            </div>
            <div class="d-flex flex-column gap-3 mt-5">

                <button class="bg-transparent border-0 text-blue fw-normal fs-5 p-0" type=" button"
                    data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                    aria-controls="collapseExample">
                    Lee nuestros consejos y guías sobre cómo crear una peticion

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-chevron-down-icon lucide-chevron-down ms-5">
                        <path d="m6 9 6 6 6-6" />
                    </svg>
                </button>

                <div class="collapse mt-2" id="collapseExample">
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo iniciar una petición</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo recolectar firmas</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo hacer ruido con tu campaña</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo hacer ruido con tu campaña</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo llegar a los medios</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-top border-bottom border-1 border-gray">
                        <span class="text-blue">Cómo contactar con los responsables</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg>
                    </div>
                </div>


            </div>
        </div>

    </section>

    <!--Peticiones-->
    <section class="w-100 bg-white py-5 px-2">
        <div class="container">
            <h3 class="fs-2 fw-bold my-3">Apoya causas que te importan</h3>
            <span class="fs-5">Encuentra peticiones que te conmuevan y alza tu voz para lograr el cambio.</span>
            <div class="d-flex align-items-center flex-wrap gap-2 mt-3 mb-4">
                @foreach ($categories as $category)
                    <button class="btn btn-outline-primary btn-blue text-blue py-3 px-4 fs-55">{{ $category->name }} <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-arrow-right-icon lucide-arrow-right ms-1">
                            <path d="M5 12h14" />
                            <path d="m12 5 7 7-7 7" />
                        </svg></button>
                @endforeach

            </div>
            <div class="row gy-4">
                @if (count($petitions) <= 0)
                    <p>No hay ninguna causa todavia!</p>

                @endif
                @foreach ($petitions as $petition)
                    <div class="col-12 col-md-3">
                        <div class="card l-card shadow-sm position-relative">
                            <img src={{ asset('petitions/' . $petition->file->name) }} class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $petition->title }}</h5>
                                <a href="#"
                                    class="text-decoration-none d-flex align-items-center gap-2 text-dark-blue fw-bold mt-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="#0c4cfa" stroke-width="2.25" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-pen-line-icon lucide-pen-line">
                                        <path d="M13 21h8" />
                                        <path
                                            d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                    </svg>{{ $petition->signeds }}</a>
                            </div>
                            <div class="arrow-pill rounded-pill d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    stroke="#f0f0f0" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-arrow-right-icon lucide-arrow-right">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!--Banner apoya el cambio-->
    <section class="w-100 bg-white py-5 px-4">
        <div class="container bg-secondary d-flex flex-lg-row flex-column align-items-center rounded-4">
            <div class="h-100 order-1 p-5 d-flex flex-column align-items-start" style="flex: 0.5">
                <h4 class="mb-4 fs-1 fw-bold">Apoya el cambio <br>
                    Contribuye hoy</h4>
                <span>
                    Change.org es una organización independiente, financiada únicamente por millones de usuarios como
                    tú. Colabora con Change para proteger el poder de las personas que marcan una diferencia.
                </span>
                <button class="btn btn-outline-secondary bg-transparent fs-5 fw-bold px-4 py-2 mt-4">Contribuir</button>
            </div>
            <div class="h-100 order-0 order-lg-2" style="flex: 0.5">
                <img class="w-100" src="https://static.change.org/homepageV3/homepage-sunrise-contribute@1x.png" alt="">
            </div>
        </div>
    </section>

@endsection