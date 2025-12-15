
@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark">Gestión de Peticiones</h3>
            <a href="{{route("admin.petition.create")}}"  class="btn btn-primary px-4 shadow-sm">
                <i  class="fas fa-plus me-2"></i> Nueva Petición
            </a>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr class="text-uppercase text-secondary" style="font-size: 0.75rem; letter-spacing: 1px;">
                            <th class="ps-4 py-3">Imagen</th>
                            <th class="py-3">Info Petición</th> <th class="py-3">Descripción</th>
                            <th class="py-3 text-center">Firmas</th>
                            <th class="py-3 text-center">Estado</th>
                            <th class="py-3 text-end pe-4">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($petitions as $petition)
                            <tr>
                                <td class="ps-4">
                                    @php
                                        $image = $petition->file
                                    @endphp

                                    @if($image && !empty($image->file_path))
                                        <img src="{{ asset('petitions/' . $image->file_path) }}"
                                             alt="img"
                                             class="rounded shadow-sm"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="rounded shadow-sm bg-light d-flex align-items-center justify-content-center text-secondary"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-image fa-lg"></i>
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <span class="fw-bold text-dark d-block">{{ Str::limit($petition->title, 40) }}</span>
                                    <small class="text-muted">ID: #{{ $petition->id }}</small>
                                </td>

                                <td class="text-muted">
                                    {{ Str::limit($petition->description, 50) }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info text-dark">{{ $petition->signeds ?? 0 }}</span>
                                </td>

                                <td class="text-center">
                                    @if($petition->status == 'aceptada')
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">Aceptada</span>
                                    @elseif($petition->status == 'pendiente')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Pendiente</span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">{{ $petition->status }}</span>
                                    @endif
                                </td>

                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.petition.edit', $petition->id) }}"  class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form method="POST" action="{{ route('admin.destroy', $petition->id) }}" onsubmit="return confirm('¿Seguro que quieres borrar esta petición?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i>
                                        <p class="h5">No hay peticiones registradas.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
