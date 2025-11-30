@extends('layouts.public')
@section('content')
    <div class="container px-md-5 px-3 d-flex flex-column align-items-center">

        @if(session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <div class="shadow rounded-2 boder-1 border-gray p-4 mt-5 w-100 ">
            <h2 class="fw-bold fs-1 text-center" id="titlecomenzar">Comenzemos el <br>cambio juntos <span
                    style="color: #bd1e19 !important">.</span> </h2>
            <form action="{{route("petition.store")}}" method="post" class="d-flex flex-column p-md-5 mt-4"
                enctype="multipart/form-data">
                @csrf
                <div class="divisor-solid my-4"></div>
                <div>
                    <h4 class="fw-bold fs-3 mt-2">Tu petición <span style="color: #bd1e19 !important">*</span></h4>
                    <p class="fs-5">Explica a la gente lo que quieres cambiar</p>
                </div>
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Titulo de la peticion </label>
                    <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                    <div class="w-100 p-3 rounded-3 shadow-sm mb-4 mt-3" style="background-color: #f9f7fc;">
                        <h6 class="fw-bold fs-4">Consejos</h6>
                        <div class="d-flex flex-column gap-2">
                            <span><span class="fw-semibold">Empieza con un verbo <br></span>Ejemplos: "Paremos, salvemos,
                                prohíban, garanticen, nos oponemos, etc"</span>
                            <span><span class="fw-semibold">Nombre lugares específicos, organizaciones o personas
                                    <br></span>Por ejemplo: "Suban el salario mínimo por hora"</span>
                        </div>

                    </div>
                </div>
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Categoria de la peticion </label>
                    <select name="category" class="form-control" required>
                        <option value="">-- Selecciona una categoría --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="mb-3 ">
                    <label for="exampleFormControlInput1" class="form-label">Destinatario de la peticion </label>
                    <input type="text" name="destinatary" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div>
                    <h4 class="fw-bold fs-3 mt-2">Cuenta tu historia <span style="color: #bd1e19 !important">*</span>
                    </h4>
                    <p class="fs-5">Empieza desde cero o utiliza la estructura que recomendamos a continuación. Siempre
                        puedes editar tu petición, incluso después de publicarla.</p>
                </div>
                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
                <div class="mt-4">
                    <h4 class="fw-bold fs-3 mt-2">Añade una imagen (opcional)</h4>
                    <p class="fs-5">Las peticiones con imágenes consiguen hasta seis veces más firmas.</p>
                </div>
                <div class="mb-3">

                    <input class="form-control" type="file" name="file" id="formFile">
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