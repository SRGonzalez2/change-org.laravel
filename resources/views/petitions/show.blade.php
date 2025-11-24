@extends('layouts.public')
@section('content')
    <!--Container-->
    <div class="container px-md-5 px-3 mt-4">
        <div class="px-2">
            <h2 class="fw-bold fs-3rem">{{$petition->title}}
            </h2>
        </div>
        <div class="row w-100 mt-5 gx-4">
            <div class="col-md-8">
                <img class="w-100 petition-img"
                     src="https://assets.change.org/photos/6/zy/tu/XvzyTUYFsYcnqzV-800x450-noPad.jpg?1758742974" alt="">

                <div class="w-100 mt-5 px-3">
                    <h6 class="fw-semibold">Firmas recientes</h6>
                    <div class="row gx-2">
                        <div class="col-4">
                            <span style="font-size: 0.75rem;"
                                  class="d-flex bg-light-blue p-3 rounded-3 w-100 text-center">Rosana
                                Zaragoza
                                •
                                hace 1 semana
                            </span>
                        </div>
                        <div class="col-4">
                            <span style="font-size: 0.75rem;" class="d-flex bg-light-blue p-3 rounded-3 w-100">Florencio
                                Rodríguez

                                •
                                hace 2 semanas

                            </span>
                        </div>
                        <div class="col-4">
                            <span style="font-size: 0.75rem;" class="d-flex bg-light-blue p-3 rounded-3 w-100">Paula
                                Grañeda
                                •
                                hace 2 semanas
                            </span>
                        </div>
                    </div>
                </div>

                <div class="divisor-solid mt-5"></div>

                <div>
                    <h3 class="fs-1 fw-bold mt-5 mb-4">El problema</h3>
                    <p>{{$petition->description}}</p>
                </div>
                <div class="divisor-solid mt-5 mb-3"></div>
                <div class="w-100 d-flex align-items-center justify-content-between mb-5">
                    <div class="d-flex align-items-center gap-3">
                        <img id="profileImg" src="https://static.change.org/ds-v2/avatar-sunshine.svg"
                             class="d-none d-lg-inline-block" alt="" width="55">
                        <span class="fw-semibold">{{$user->name}}<br><span class="fw-normal">Creador de la
                                peticion</span></span>
                    </div>
                    <button class="btn btn-outline-secondary fw-semibold rounded-3">Consultas de medios de
                        comunicacion</button>
                </div>
                <div class="divisor-solid mt-5"></div>
                <div>
                    <h3 class="fs-1 fw-bold mt-4 mb-5">Opiniones de firmantes</h3>
                    <h5 class="fs-4 fw-normal">Comentarios destacados</h5>
                    <article class="border mt-3 border-1 border-gray rounded-3 d-flex flex-column p-3">
                        <div class="d-flex align-items-center gap-3">
                            <img id="profileImg" src="https://static.change.org/ds-v2/avatar-sunshine.svg"
                                 class="d-none d-lg-inline-block" alt="" width="45">
                            <span class="fw-semibold">Victoria, <span class="fw-normal">Las palmas de Gran Canaria
                                    <br>hace 2 meses</span></span>
                        </div>
                        <span class="mt-4"><i>"Yo sufrí violencia por mi pareja varios años hasta un día que los vecinos
                                llamaron a
                                la
                                policía vino GC Y LOCAL entraron en la casa y yo estaba fuera porque no me dejaba las
                                llaves de mi coche me arrastro por los pelos para entrarme como yo chillé y vio a la
                                policía me dejó sentada y yo del shock me quedé ahí en la acera,orden de alejamiento que
                                se..."</i></span>
                        <a class="fw-bold fs-6 text-black mt-2">Ver el texto completo</a>
                        <div class="d-flex align-items-center gap-4 mt-3">
                            <div class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                                              width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d3d3d"
                                                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                                              class="lucide lucide-heart-icon lucide-heart">
                                    <path
                                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                </svg><span>8 me gusta</span></div>

                            <div class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                                              width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d3d3d"
                                                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                                              class="lucide lucide-flag-icon lucide-flag">
                                    <path
                                        d="M4 22V4a1 1 0 0 1 .4-.8A6 6 0 0 1 8 2c3 0 5 2 7.333 2q2 0 3.067-.8A1 1 0 0 1 20 4v10a1 1 0 0 1-.4.8A6 6 0 0 1 16 16c-3 0-5-2-8-2a6 6 0 0 0-4 1.528" />
                                </svg><span>Denunciar</span></div>
                        </div>
                    </article>
                    <article class="border mt-3 border-1 border-gray rounded-3 d-flex flex-column p-3">
                        <div class="d-flex align-items-center gap-3">
                            <img id="profileImg" src="https://static.change.org/ds-v2/avatar-sunshine.svg"
                                 class="d-none d-lg-inline-block" alt="" width="45">
                            <span class="fw-semibold">Victoria, <span class="fw-normal">Las palmas de Gran Canaria
                                    <br>hace 2 meses</span></span>
                        </div>
                        <span class="mt-4"><i>"Yo sufrí violencia por mi pareja varios años hasta un día que los vecinos
                                llamaron a
                                la
                                policía vino GC Y LOCAL entraron en la casa y yo estaba fuera porque no me dejaba las
                                llaves de mi coche me arrastro por los pelos para entrarme como yo chillé y vio a la
                                policía me dejó sentada y yo del shock me quedé ahí en la acera,orden de alejamiento que
                                se..."</i></span>
                        <a class="fw-bold fs-6 text-black mt-2">Ver el texto completo</a>
                        <div class="d-flex align-items-center gap-4 mt-3">
                            <div class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                                              width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d3d3d"
                                                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                                              class="lucide lucide-heart-icon lucide-heart">
                                    <path
                                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                </svg><span>8 me gusta</span></div>

                            <div class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                                              width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d3d3d"
                                                                              stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                                                                              class="lucide lucide-flag-icon lucide-flag">
                                    <path
                                        d="M4 22V4a1 1 0 0 1 .4-.8A6 6 0 0 1 8 2c3 0 5 2 7.333 2q2 0 3.067-.8A1 1 0 0 1 20 4v10a1 1 0 0 1-.4.8A6 6 0 0 1 16 16c-3 0-5-2-8-2a6 6 0 0 0-4 1.528" />
                                </svg><span>Denunciar</span></div>
                        </div>
                    </article>

                    <button class="btn btn-outline-secondary fw-bold mx-auto d-block mx-auto p-075 mt-4 mb-5">Ver todos
                        los
                        comentarios</button>
                </div>

            </div>
            <div class="col-md-4">
                <div class="shadow d-flex flex-column p-4 rounded-2 w-100">
                    <h5 class="text-center fs-1 fw-bold">{{$petition->signeds}}</h5>
                    <button class="bg-transparent border-0 fw-normal fs-7 p-0 mt-1" type=" button"
                            data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">
                        Firmas verificadas

                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             stroke="black" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round"
                             class="lucide lucide-chevron-down-icon lucide-chevron-down ms-2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>
                    <div class="collapse mt-2 text-center" id="collapseExample">
                        <span class="text-light-gray"><i class="text-light-gray">Change.org ayuda a verificar que las
                                firmas son
                                de personas
                                reales.</i></span>

                    </div>
                    <div class="divisor-solid my-4">
                    </div>
                    <h5 class="fs-4 fw-bold mb-3">Firma esta petición</h5>
                    <form>
                        <div class="mb-2">
                            <label for="nombre" class="form-label fs-7">Nombre</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="mb-2">
                            <label for="apellidos" class="form-label fs-7">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos">
                        </div>
                        <div class="mb-2">
                            <label for="email" class="form-label fs-7">Correo electrónico</label>
                            <input type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-2">
                            <label for="ciudad" class="form-label fs-7">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad">
                        </div>
                        <div class="mb-2">
                            <label for="pais" class="form-label fs-7">Pais</label>
                            <select class="form-select" id="pais" aria-label="Default select example">
                                <option selected>España</option>
                                <option value="1">Alemania</option>
                                <option value="2">Reino Unido</option>
                                <option value="3">Francia</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="postal" class="form-label fs-7">Codigo Postal</label>
                            <input type="text" class="form-control" id="postal">
                        </div>
                        <div class="form-check mb-1 mt-2">
                            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault1">
                            <label class="form-check-label fs-8" for="radioDefault1">
                                Quiero saber si esta peticion gana y como puedo ayudar a otras peticiones ciudadanas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault2" checked>
                            <label class="form-check-label fs-8" for="radioDefault1">
                                No quiero saber como avanaza esta peticion ni otras peticiones importantes
                            </label>
                        </div>
                        <button class="btn btn-primary fw-bold rounded-2 w-100 py-2 fs-5 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="lucide lucide-pencil-line-icon lucide-pencil-line me-lg-2">
                                <path d="M13 21h8" />
                                <path d="m15 5 4 4" />
                                <path
                                    d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z" />
                            </svg>Firma la petición</button>
                        <div class="form-check mt-3 mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                            <label class="form-check-label fs-8" for="checkDefault">
                                No mostrar publicamente mi firma y mi comentario en esta peticion.
                            </label>
                        </div>
                        <span style="font-size: 0.7rem;">Procesamos tus datos personales de acuerdo con nuestras
                            <b class="text-dark-blue text-decoration-underline">Política de
                                privacidad</b> y <b class="text-dark-blue text-decoration-underline">Normas de
                                uso</b>.</span>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
