<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * CONTROLADOR: ProfileController (Laravel Breeze)
 * * DESCRIPCIÓN:
 * Este controlador es instalado por el paquete de autenticación Laravel Breeze.
 * Se encarga de la gestión del perfil de los usuarios administradores, permitiendo
 * modificar sus datos de acceso (nombre, correo), controlar los estados de verificación
 * y realizar la eliminación segura de cuentas mediante la validación de la sesión actual.
 */
class ProfileController extends Controller
{
    /**
     * Muestra el formulario de edición de perfil del administrador autenticado.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Inyecta los datos del usuario en sesión
        ]);
    }

    /**
     * Actualiza la información de la cuenta del administrador en la base de datos.
     * * SEGURIDAD: Utiliza un Form Request personalizado (ProfileUpdateRequest) para validar los datos.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Llena el modelo con los datos validados del formulario
        $request->user()->fill($request->validated());

        // Si el usuario alteró su correo electrónico, se revoca la fecha de verificación
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Persiste los cambios en la tabla 'users'
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina de forma definitiva la cuenta del administrador del sistema.
     * * SEGURIDAD: Invalida los tokens de sesión y exige la contraseña actual para prevenir ataques de secuestro de sesión.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Valida estrictamente que la contraseña ingresada coincida con la del usuario logueado
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Cierra la sesión activa del usuario en el framework
        Auth::logout();

        // Aplica el método Delete sobre el registro del usuario
        $user->delete();

        // Destruye los datos guardados en la sesión web y regenera el token CSRF para evitar exploits de seguridad
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}   