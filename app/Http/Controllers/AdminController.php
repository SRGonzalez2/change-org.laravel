<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // 1. Listar todas las peticiones para el panel
    public function indexPeticiones() {
        $peticiones = Petition::with(['categoria', 'user', 'files'])
            ->withCount('firmas')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $peticiones
        ], 200);
    }

    // 2. Eliminar cualquier petición a la fuerza
    public function destroyPeticion($id) {
        $peticion = Petition::findOrFail($id);

        $peticion->delete();
        return response()->json([
            'success' => true,
            'message' => 'Petición eliminada correctamente por el administrador.'
        ], 200);
    }
}
