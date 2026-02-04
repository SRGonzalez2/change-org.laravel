<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PetitionController extends Controller
{
    use AuthorizesRequests;

    private function sendResponse($data, $message, $code = 200) {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    private function sendError($error, $errorMessages = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) { $response['errors'] = $errorMessages; }
        return response()->json($response, $code);
    }

    public function index() {
        try {
            $peticiones = Petition::with(['user', 'category', 'files'])->get();
            return $this->sendResponse($peticiones, 'Peticiones recuperadas con éxito');
        } catch (\Exception $e) {
            return $this->sendError('Error al recuperar peticiones', $e->getMessage(), 500);
        }
    }

    public function list() {
        try {
            $peticiones = Petition::all();
            return response()->json($peticiones, 200); // Paginación suele ir directa
        } catch (\Exception $e) {
            return $this->sendError('Error en la paginación', $e->getMessage(), 500);
        }
    }

    public function listMine() {
        try {
            $user = Auth::user();
            $peticiones = Petition::where('user_id', $user->id)->with(['user', 'category', 'files'])->get();
            return $this->sendResponse($peticiones, 'Tus peticiones recuperadas con éxito');
        } catch (\Exception $e) {
            return $this->sendError('Error al recuperar tus peticiones', $e->getMessage(), 500);
        }
    }

    public function show($id) {
        try {
            $peticion = Petition::with(['user', 'category', 'files'])->findOrFail($id);
            return $this->sendResponse($peticion, 'Petición encontrada');
        } catch (\Exception $e) {
            return $this->sendError('Petición no encontrada', [], 404);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Error de validación', $validator->errors(), 422);
        }
        try {
            if ($file = $request->file('file')) {
                $path = $file->store('peticiones', 'public');
                $peticion = new Petition($request->all());
                $peticion->user_id = Auth::id();
                $peticion->signeds = 0;
                $peticion->status = 'pending';
                $peticion->save();
                $peticion->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $path
                ]);
                return $this->sendResponse($peticion->load('files'), 'Petición creada con
                éxito', 201);
            }
            return $this->sendError('El archivo es obligatorio', [], 422);
        } catch (\Exception $e) {
            return $this->sendError('Error al crear la petición', $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $peticion = Petition::findOrFail($id);
            if ($request->user()->cannot('update', $peticion)) {
                return $this->sendError('No autorizado', [], 403);
            }
            $peticion->update($request->all());
            return $this->sendResponse($peticion, 'Petición actualizada con éxito');
        } catch (\Exception $e) {
            return $this->sendError('Error al actualizar', $e->getMessage(), 500);
        }
    }

    public function firmar(Request $request, $id) {
        try {
            $peticion = Petition::findOrFail($id);
            $user = Auth::user();
            if ($peticion->firmas()->where('user_id', $user->id)->exists()) {
                return $this->sendError('Ya has firmado esta petición', [], 403);
            }
            $peticion->firmas()->attach($user->id);
            $peticion->increment('signeds'); // Más limpio que $peticion‐>firmantes + 1
            return $this->sendResponse($peticion, 'Petición firmada con éxito', 201);
        } catch (\Exception $e) {
            return $this->sendError('No se pudo firmar la petición', $e->getMessage(), 500);
        }
    }

    public function delete(Request $request, $id) {
        try {
            $peticion = Petition::findOrFail($id);
            if ($request->user()->cannot('delete', $peticion)) {
                return $this->sendError('No autorizado', [], 403);
            }
            // Eliminar archivos físicos
            foreach ($peticion->files as $file) {
                Storage::disk('public')->delete($file->file_path);
            }
            $peticion->delete();
            return $this->sendResponse(null, 'Petición eliminada con éxito');
        } catch (\Exception $e) {
            return $this->sendError('Error al eliminar', $e->getMessage(), 500);
        }
    }

    public function fileUpload(Request $request, $peticione_id) {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:4096',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Archivo no váwlido', $validator->errors(), 422);
        }

        try {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('images', $filename, 'public');
            $fileModel = File::create([
                'petition_id' => $peticione_id,
                'name' => $filename,
                'file_path' => $path
            ]);
            return $this->sendResponse($fileModel, 'Archivo subido con éxito');
        } catch (\Exception $e) {
            return $this->sendError('Error al subir archivo', $e->getMessage(), 500);
        }
    }


}
