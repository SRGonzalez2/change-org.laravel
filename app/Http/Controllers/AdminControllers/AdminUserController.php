<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class AdminUserController extends Controller
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

    public function indexUsers() {
        $usuarios = User::withCount('petitions')->get();

        return response()->json([
            'success' => true,
            'data' => $usuarios
        ], 200);
    }


    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:user,admin'],
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            event(new Registered($user));

            return $this->sendResponse($user, 'Usuario creado correctamente', 201);
        } catch (Exception $e) {
            return $this->sendError('Error al crear el usuario', $e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return $this->sendResponse(null, 'Usuario eliminado correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al eliminar el usuario', $e->getMessage(), 500);
        }
    }

}
