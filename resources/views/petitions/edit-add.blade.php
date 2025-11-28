@extends('layouts.public')
@section('content')
    <div class="container px-md-5 px-3 d-flex flex-column align-items-center">

        @if(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="shadow rounded-2 boder-1 border-gray p-4 mt-5 w-100 ">
            <h2 class="fw-bold fs-1 text-center" id="titlecomenzar">Comenzemos el <br>cambio juntos <span
                    style="color: #bd1e19 !important">.</span> </h2>
            <form action="{{route("petition.store")}}" method="post" class="d-flex flex-column p-md-5 mt-4">
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Seleciona el ámbito de tu peticion <span
                            style="color: #bd1e19 !important">*</span></label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Local</option>
                        <option value="1">Nacional</option>
                        <option value="2">Global</option>º
                    </select>
                </div>
                <div class="w-100 p-3 rounded-3 shadow-sm mb-4" style="background-color: #f9f7fc;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="lucide lucide-chart-spline-icon lucide-chart-spline me-2">
                        <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                        <path d="M7 16c.5-2 1.5-7 4-7 2 0 2 3 4 3 2.5 0 4.5-5 5-7" />
                    </svg>
                    <span class="fs-6">Las peticiones locales tienen un <span class="fw-bold">50% más de
                            probabilidad</span> de
                        conseguir la
                        victoria.</span>
                </div>
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Barrio, ciudad, estado o región <span
                            style="color: #bd1e19 !important">*</span></label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="divisor-solid my-4"></div>
                <div>
                    <h4 class="fw-bold fs-3 mt-2">Tu petición <span style="color: #bd1e19 !important">*</span></h4>
                    <p class="fs-5">Explica a la gente lo que quieres cambiar</p>
                </div>
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Titulo de la peticion </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="w-100 p-3 rounded-3 shadow-sm mb-4" style="background-color: #f9f7fc;">
                    <h6 class="fw-bold fs-4">Consejos</h6>
                    <div class="d-flex flex-column gap-2">
                        <span><span class="fw-semibold">Empieza con un verbo <br></span>Ejemplos: "Paremos, salvemos,
                            prohíban, garanticen, nos oponemos, etc"</span>
                        <span><span class="fw-semibold">Nombre lugares específicos, organizaciones o personas
                                <br></span>Por ejemplo: "Suban el salario mínimo por hora"</span>
                    </div>

                </div>

                <div>
                    <h4 class="fw-bold fs-3 mt-2">Cuenta tu historia <span style="color: #bd1e19 !important">*</span>
                    </h4>
                    <p class="fs-5">Empieza desde cero o utiliza la estructura que recomendamos a continuación. Siempre
                        puedes editar tu petición, incluso después de publicarla.</p>
                </div>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                <div class="mt-4">
                    <h4 class="fw-bold fs-3 mt-2">Añade una imagen (opcional)</h4>
                    <p class="fs-5">Las peticiones con imágenes consiguen hasta seis veces más firmas.</p>
                </div>
                <div class="mb-3">

                    <input class="form-control" type="file" id="formFile">
                    <label for="formFile" class="form-label mt-1">Las imágenes de 1200 x 675 pixeles como mínimo se
                        verán
                        bien en cualquier tipo de pantalla</label>
                </div>
                <div class="mt-5">
                    <button class="btn btn-primary fw-semibold w-100 py-3 fs-5">Crear peticion</button>
                </div>

            </form>
        </div>
    </div>

@endsection
