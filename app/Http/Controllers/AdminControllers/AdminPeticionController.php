<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPeticionController extends Controller
{

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

    private function sendResponse($data, $message, $code = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    // 1. Listar todas las peticiones para el panel
    public function indexPeticiones() {
        $peticiones = Petition::with(['category', 'user', 'files'])
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

    //3. Añadir nueva peticion
    public function storePeticion(Request $request)
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

    //4. Show peticion
    public function showPeticion($id)
    {
        $peticion = Petition::with(['category', 'user', 'files'])->findOrFail($id);
        return $this->sendResponse($peticion, 'Petición obtenida correctamente');
    }

    //5. Update peticion
    public function updatePeticion(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'nullable|file|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',
            'status'      => 'in:pending,accepted',
        ]);

        try {
            $petition = Petition::findOrFail($id);
            $petition->title       = $request->title;
            $petition->description = $request->description;
            $petition->status      = $request->status ?? $petition->status;
            $petition->category()->associate(Category::findOrFail($request->category_id));
            $petition->save();

            if ($request->hasFile('file')) {
                $this->fileUpload($request, $petition->id);
            }

            return $this->sendResponse($petition->load('files'), 'Petición actualizada correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al actualizar la petición', $e->getMessage(), 500);
        }
    }


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
