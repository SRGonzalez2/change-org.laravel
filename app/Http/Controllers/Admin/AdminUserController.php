<?php

namespace App\Http\Controllers\Admin;

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

    // Listar usuarios
    public function index()
    {
        try {
            $users = User::all();
            return $this->sendResponse($users, 'Usuarios obtenidos correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al obtener usuarios', $e->getMessage(), 500);
        }
    }

    // Crear usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')],
            'password' => ['required', Rules\Password::defaults()],
            'role_id' => ['required', 'integer'],
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

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required', 'integer'],
        ]);

        try {
            $user->name = $request->name;
            $user->email = strtolower($request->email);
            $user->role_id = $request->role_id;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return $this->sendResponse($user, 'Usuario actualizado correctamente');
        } catch (Exception $e) {
            return $this->sendError('Error al actualizar el usuario', $e->getMessage(), 500);
        }
    }

    // Eliminar usuario
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
