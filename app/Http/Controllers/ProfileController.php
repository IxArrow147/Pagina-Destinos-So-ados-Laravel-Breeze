<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
            'confirm_deletion' => ['accepted'],
        ], [
            'password.required' => 'Ingresa tu contraseña para confirmar.',
            'password.current_password' => 'La contraseña no es correcta.',
            'confirm_deletion.accepted' => 'Debes confirmar que entiendes las consecuencias.',
        ]);

        $user = $request->user();

        // Protección: no dejar la plataforma sin administrador.
        if ($user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return Redirect::back()->withErrors([
                'password' => 'No puedes eliminar la cuenta porque eres el único administrador. Asigna el rol a otro usuario primero.',
            ], 'userDeletion');
        }

        $userId = $user->id;
        $email = $user->email;

        Auth::logout();

        // Se elimina la cuenta y todo lo asociado en una sola transacción:
        // si algo falla, no queda nada a medias.
        DB::transaction(function () use ($userId, $email) {
            DB::table('sessions')->where('user_id', $userId)->delete();
            DB::table('password_reset_tokens')->where('email', $email)->delete();
            User::whereKey($userId)->delete();
        });

        // Trazabilidad sin datos personales: solo el id, nunca el correo.
        Log::info('Cuenta de usuario eliminada por su titular', ['user_id' => $userId]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'account-deleted');
    }
}