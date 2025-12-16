@extends('layouts.admin')
@section('content')

    @php
        $isEdit = isset($user);
    @endphp

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                {{-- Cabecera con título y botón de volver --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1"> {{ $isEdit ? 'Editar Usuario' : 'Nuevo Usuario' }}</h1>
                        <p class="text-muted mb-0">{{ $isEdit ? 'Actualiza la información del usuario' : 'Crea un nuevo usuario desde el panel' }}</p>
                    </div>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <form action="{{ $isEdit ? route('admin.user.update', $user->id) : route('admin.user.store') }}" method="POST">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        {{-- Nombre --}}
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{ old('name', $user->name ?? '') }}" required>
                            <label for="name">Nombre completo</label>
                            @error('name') <span class="text-danger small ms-2">{{ $message }}</span> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-floating mb-3">
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{old('name', $user->email ?? '') }}"
                                   required>
                            <label for="email">Correo Electrónico</label>
                            @error('email') <span class="text-danger small ms-2">{{ $message }}</span> @enderror
                        </div>

                        {{-- Contraseña (Obligatoria al crear) --}}
                        <div class="form-floating mb-4">
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   id="password"
                                   placeholder="Contraseña"
                                {{ $isEdit ? '' : 'required' }}>
                            <label for="password">
                                {{ $isEdit ? 'Contraseña (dejar vacío para no cambiar)' : 'Contraseña (Mínimo 8 caracteres)' }}
                            </label>
                            @error('password') <span class="text-danger small ms-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted text-uppercase">Asignar Rol</label>
                            <div class="d-flex gap-3">

                                {{-- Opción USUARIO (Valor 1) --}}
                                <div class="form-check card-radio p-0 flex-fill">
                                    <input class="btn-check"
                                           type="radio"
                                           name="role_id"
                                           id="roleUser"
                                           value="1"
                                        {{ old('role_id', $user->role_id ?? 1) == 1 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-secondary w-100 py-3" for="roleUser">
                                        <i class="bi bi-person me-2"></i> Usuario
                                    </label>
                                </div>

                                {{-- Opción ADMIN (Valor 2) --}}
                                <div class="form-check card-radio p-0 flex-fill">
                                    <input class="btn-check"
                                           type="radio"
                                           name="role_id"
                                           id="roleAdmin"
                                           value="2"
                                        {{ old('role_id', $user->role_id ?? 1) == 2 ? 'checked' : '' }}>
                                    <label class="btn btn-outline-danger w-100 py-3" for="roleAdmin">
                                        <i class="bi bi-shield-lock me-2"></i> Administrador
                                    </label>
                                </div>

                            </div>
                            @error('role_id') <span class="text-danger small ms-2">{{ $message }}</span> @enderror
                        </div>

                        {{-- Botón de Guardar --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-lg text-white" style="background-color: #DC1E1E;">
                                <i class="bi bi-person-plus-fill me-2"></i> Crear Usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
