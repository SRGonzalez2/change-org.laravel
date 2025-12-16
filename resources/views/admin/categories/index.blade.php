@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark">Gestión de Categorias</h3>
            <a href="{{route("admin.category.create")}}"  class="btn btn-primary px-4 shadow-sm">
                <i  class="fas fa-plus me-2"></i> Nueva Categoria
            </a>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr class="text-uppercase text-secondary" style="font-size: 0.75rem; letter-spacing: 1px;">
                            <th class="ps-4 py-3">Descripción</th>
                            <th class="py-3 text-center">Numero de usos</th>
                            <th class="py-3 text-end pe-4">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <span class="fw-bold text-dark d-block">{{ Str::limit($category->name, 40) }}</span>
                                    <small class="text-muted">ID: #{{ $category->id }}</small>
                                </td>

                                <td class="text-muted text-center">
                                    {{ count($category->petitions) }}
                                </td>

                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.category.edit', $category->id) }}"  class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form method="POST" action="{{ route('admin.category.destroy', $category->id) }}" onsubmit="return confirm('¿Seguro que quieres borrar esta petición?');" class="d-inline">
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
                                        <p class="h5">No hay categorias registradas.</p>
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
