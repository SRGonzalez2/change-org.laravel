@extends('layouts.public')

@section('content')

    <style>
        .image-preview-container {
            width: 100%;
            height: 250px;
            background-color: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .image-preview-container:hover {
            border-color: #DC1E1E;
            background-color: #fff5f5;
        }
        .image-preview-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
    </style>

    @php
        $isEdit = isset($petition);
    @endphp


    <div class="container-fluid py-4 bg-light" style="min-height: 100vh;">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 fw-bold text-dark mb-1"> {{ $isEdit ? 'Editar Petición' : 'Nueva Petición' }}</h1>
                <p class="text-muted mb-0"> {{ $isEdit ? 'Actualiza la información de la campaña' : 'Crea una nueva campaña desde el panel' }}</p>
            </div>
            <a href="{{route('admin.home')}}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>Volver
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">

                <form action="{{route('peticiones.update', $petition->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="card form-card bg-white p-4">
                        <div class="row g-4">

                            {{-- DATOS --}}
                            <div class="col-md-7">
                                <h5 class="fw-bold mb-3 text-secondary">Información</h5>

                                {{-- Título --}}
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Título"  value="{{ old('title', $petition->title ?? '') }}" required>
                                    <label for="title">Título de la petición</label>
                                </div>

                                {{-- Descripción --}}
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="description" name="description" placeholder="Descripción" style="height: 150px" required>{{ old('title', $petition->description ?? '') }}</textarea>
                                    <label for="description">Descripción detallada</label>
                                </div>

                                {{-- Categoría --}}
                                <div class="mb-3">
                                    <label class="form-label fw-bold small text-muted text-uppercase">Categoría</label>
                                    <select class="form-select form-select-lg" name="category_id" required>
                                        <option value="" disabled {{ old('category_id', $petition->category_id ?? '') ? '' : 'selected' }}>
                                            Selecciona una categoría...
                                        </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ (old('category_id', $petition->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- IMAGEN --}}
                            <div class="col-md-5">
                                <h5 class="fw-bold mb-3 text-secondary">Imagen Principal</h5>

                                <div class="mb-3">
                                    <label for="file" class="d-block w-100">
                                        <div class="image-preview-container text-center" id="imagePreviewBox">
                                            {{-- Placeholder --}}
                                            <div id="placeholderInfo" @if($isEdit && $petition->file) style="display:none;" @endif>
                                                <i class="bi bi-cloud-arrow-up fs-1 text-muted mb-2 d-block"></i>
                                                <span class="text-muted fw-bold">Subir imagen</span>
                                                <p class="small text-muted mt-1">Haz clic para seleccionar</p>
                                            </div>

                                            {{-- Preview IMG --}}
                                            @if($isEdit && $petition->file)
                                                <img id="previewImg" src="{{ asset('petitions/' . $petition->file->file_path) }}" class="image-preview-img">
                                            @else
                                                <img id="previewImg" src="" class="image-preview-img d-none">
                                            @endif
                                        </div>
                                    </label>

                                    {{-- Input real oculto --}}
                                    <input type="file" class="form-control d-none"
                                           id="file" name="file" accept="image/*"
                                           onchange="previewImage(this)"
                                        {{ $isEdit ? '' : 'required' }}>

                                    @error('file')
                                    <div class="text-danger small mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="alert alert-light border small text-muted">
                                    <i class="bi bi-info-circle me-1"></i> La imagen {{ $isEdit ? 'puede ser actualizada' : 'es obligatoria' }}.
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-lg px-5 text-white" style="background-color: #DC1E1E;">
                                <i class="bi bi-rocket-takeoff me-2"></i>{{ $isEdit ? 'Actualizar Petición' : 'Publicar Petición' }}
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script para previsualizar la imagen --}}
    <script>
        function previewImage(input) {
            var preview = document.getElementById('previewImg');
            var placeholder = document.getElementById('placeholderInfo');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if(placeholder) placeholder.classList.add('d-none');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
