@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 fw-bold text-dark mb-0">Nueva Categoría</h1>
                    <a href="{{ route('admin.categories') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form  method="POST">
                        @csrf

                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" value="{{ old('name') }}" required>
                            <label for="name">Nombre de la Categoría</label>
                            @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #DC1E1E;">
                                Crear Categoría
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
