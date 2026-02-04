<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPetitionController extends Controller
{
    private function sendResponse($data, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    private function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    // Ver todas las peticiones (admin)
    public function index()
    {
        try {
            $petitions = Petition::with(['user', 'category', 'files'])
                ->orderBy('created_at', 'desc')
                ->get();

            return $this->sendResponse($petitions, 'Peticiones obtenidas correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al obtener peticiones', $e->getMessage(), 500);
        }
    }

    // Eliminar una petición
    public function delete($id)
    {
        try {
            $petition = Petition::findOrFail($id);

            foreach ($petition->files as $file) {
                Storage::disk('public')->delete($file->file_path);
                $file->delete();
            }

            $petition->delete();

            return $this->sendResponse(null, 'Petición eliminada correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al eliminar la petición', $e->getMessage(), 500);
        }
    }

    // Crear petición (admin)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $category = Category::findOrFail($request->category_id);

            $petition = new Petition();
            $petition->title = $request->title;
            $petition->description = $request->description;
            $petition->signeds = 0;
            $petition->status = 'pending';
            $petition->destinatary = 'everyone';
            $petition->category()->associate($category);
            $petition->user()->associate(Auth::user());
            $petition->save();

            $this->fileUpload($request, $petition->id);

            return $this->sendResponse($petition->load('files'), 'Petición creada con éxito', 201);
        } catch (Exception $e) {
            return $this->sendError('Error al crear la petición', $e->getMessage(), 500);
        }
    }

    // Actualizar petición
    public function update(Request $request, Petition $petition)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'file' => 'nullable|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $petition->update([
                'title' => $request->title,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            if ($request->hasFile('file')) {
                foreach ($petition->files as $file) {
                    Storage::disk('public')->delete($file->file_path);
                    $file->delete();
                }
                $this->fileUpload($request, $petition->id);
            }

            return $this->sendResponse($petition->load('files'), 'Petición actualizada correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al actualizar la petición', $e->getMessage(), 500);
        }
    }

    // Subida de archivos
    private function fileUpload(Request $request, $petition_id)
    {
        if (!$request->hasFile('file')) {
            return null;
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('petitions', $filename, 'public');

        return File::create([
            'petition_id' => $petition_id,
            'name' => $filename,
            'file_path' => $path
        ]);
    }
}
