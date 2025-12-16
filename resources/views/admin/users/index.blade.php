
@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark">Gestión de Usuarios</h3>
            <a href="{{route("admin.user.create")}}"  class="btn btn-primary px-4 shadow-sm">
                <i  class="fas fa-plus me-2"></i> Nuevo Usuario
            </a>
        </div>

        <div class="card shadow border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr class="text-uppercase text-secondary" style="font-size: 0.75rem; letter-spacing: 1px;">
                            <th class="ps-4 py-3">Nombre</th>
                            <th class="py-3">Email</th>
                            <th class="py-3 text-center">Rol</th>
                            <th class="py-3 text-center">Fecha de Creación</th>
                            <th class="py-3 text-end pe-4">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>

                                <td>
                                    <span class="fw-bold text-dark d-block">{{ Str::limit($user->name, 40) }}</span>
                                    <small class="text-muted">ID: #{{ $user->id }}</small>
                                </td>

                                <td class="text-muted">
                                    {{ Str::limit($user->email, 50) }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info text-dark">{{ $user->role_id == 2 ? "Administrador" : "Usuario"}}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark">{{ $user->created_at}}</span>
                                </td>


                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"  class="btn btn-outline-primary btn-sm" title="Editar">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <form method="POST" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('¿Seguro que quieres borrar esta petición?');" class="d-inline">
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
                                        <p class="h5">No hay usuarios registrados.</p>
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
