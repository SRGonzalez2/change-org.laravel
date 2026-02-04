<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
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

    public function index()
    {
        try {
            $categories = Category::all();
            return $this->sendResponse($categories, 'Categorías obtenidas correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al obtener categorías', $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        try {
            $category = Category::create([
                'name' => $request->name
            ]);

            return $this->sendResponse($category, 'Categoría creada correctamente', 201);
        } catch (Exception $e) {
            return $this->sendError('Error al crear la categoría', $e->getMessage(), 500);
        }
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        try {
            $category->update([
                'name' => $request->name
            ]);

            return $this->sendResponse($category, 'Categoría actualizada correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al actualizar la categoría', $e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();

            return $this->sendResponse(null, 'Categoría eliminada correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al eliminar la categoría', $e->getMessage(), 500);
        }
    }
}
