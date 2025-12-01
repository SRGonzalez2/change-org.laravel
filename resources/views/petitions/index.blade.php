@extends('layouts.public')

@section('content')
    <!--Main-->
    <main class="container px-lg-5 mt-lg-5 mt-4">
        <div class="w-100 d-flex flex-column align-items-center pb-5">
            <div class="d-flex align-items-center gap-2 mt-lg-4 px-2" id="hero-form">
                <div class="position-relative d-flex flex-grow-1">
                    <svg id="lupa-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-search-icon lucide-search">
                        <path d="m21 21-4.34-4.34" />
                        <circle cx="11" cy="11" r="8" />
                    </svg>
                    <input type="text" placeholder="Buscar peticiones"
                        class="form-control flex-grow-1 border-gray h-100 px-5 py-3">
                </div>
                <button class="btn btn-primary fw-semibold px-4 py-3 d-none d-md-inline-block">Buscar</button>
            </div>
            <section class="w-100 d-flex flex-column mt-5 px-2">
                <div class="w-100 d-flex flex-column flex-lg-row justify-content-between">
                    <p class="fs-4">{{count($petitions)}} resultados</p>
                    <button class="btn btn-outline-primary btn-blue text-blue dropdown-toggle"
                        data-bs-toggle="dropdown">Ordenar por: Actividad
                        reciente </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Actividad reciente <br><span class="fs-8">Peticiones con
                                    mas
                                    firmas en
                                    los ultimos 7 dias</span></a></li>
                        <li><a class="dropdown-item" href="#">Con mas firmas <br><span class="fs-8">Las peticiones con
                                    mas
                                    firmas en
                                    mas firmas primero</span></a></li>
                        <li><a class="dropdown-item" href="#">Con menos firmas <br><span class="fs-8">Peticiones con
                                    menos firmas primero</span></a></li>
                        <li><a class="dropdown-item" href="#">Nuevas<br><span class="fs-8">Las peticiones creadas
                                    recientemente primero</span></a></li>
                    </ul>
                </div>
                <div class="row mt-4 gx-5">
                    <aside class="col-12 col-md-3">
                        <div class="d-flex flex-column">
                            <div class="mb-5">
                                <label for="ubicacion" class="form-label fw-bold fs-5 mb-1º">Ubicacion</label>
                                <div class="position-relative d-flex">
                                    <svg id="lupa-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-search-icon lucide-search">
                                        <path d="m21 21-4.34-4.34" />
                                        <circle cx="11" cy="11" r="8" />
                                    </svg>
                                    <input type="text" id="ubicacion" placeholder="Ciudad o pais"
                                        class="form-control flex-grow-1 pe-3 border-gray h-100 px-5 py-3">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="ubicacion" class="form-label fw-bold fs-5 mb-2">Estado</label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" checked type="radio" name="radioDefault"
                                        id="radioDefault1">
                                    <label class="form-check-label fw-medium" for="radioDefault1">
                                        Todas las peticiones
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2">
                                    <label class="form-check-label fw-medium" for="radioDefault2">
                                        Solo victorias
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault3">
                                    <label class="form-check-label fw-medium" for="radioDefault3">
                                        Populaes
                                    </label>
                                </div>
                            </div>
                            <div class="mb-5">
                                <label for="ubicacion" class="form-label fw-bold fs-5">Temas</label>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    @foreach ($categories as $category)
                                        <a
                                            class="btn btn-outline-primary btn-blue text-blue rounded-1">{{ $category->name }}</a>

                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </aside>
                    <section class="col-12 col-md-9">
                        <div class="d-flex flex-column gap-4">
                            @foreach($petitions as $petition)
                                <article class="row peticion-card gx-2 border-bottom border-1 pb-4">
                                    <div class="col-9">
                                        <div>
                                            <h5 class="fs-3 fw-bold">{{$petition->title}}</h5>
                                            <span
                                                class="d-none d-md-inline-block">{{substr($petition->description, 0, 400)}}...</span>

                                            <div
                                                class="d-flex column-gap-5 align-items-lg-center row-gap-2 mt-4 flex-column flex-md-row">
                                                <a class="btn btn-primary" href="{{ route('petitions.show', $petition->id) }}">Ver peticion</a>
                                                <a href="#"
                                                    class="text-decoration-none d-flex align-items-center gap-2 text-dark-blue fw-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        viewBox="0 0 24 24" fill="none" stroke="#0c4cfa" stroke-width="2.25"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="lucide lucide-pen-line-icon lucide-pen-line d-none d-md-inline-block">
                                                        <path d="M13 21h8" />
                                                        <path
                                                            d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                                                    </svg>{{$petition->signeds}} firmas</a>
                                                <span class="fs-8 text-light-gray">España - Creada el
                                                    {{ strftime("%e de %B de %Y", strtotime($petition->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <img class="rounded-2" src={{ asset('petitions/' . $petition->file->name) }} alt="">
                                    </div>

                                </article>
                            @endforeach
                        </div>
                    </section>
                </div>

            </section>
        </div>
    </main>

@endsection
