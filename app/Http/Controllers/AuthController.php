<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function mostrarLogin(): View
    {
        return view('auth.login');
    }

    public function iniciarSesion(
        Request $request
    ): RedirectResponse {
        $datos = $request->validate([
            'usuario' => [
                'required',
                'string',
            ],
            'contrasena' => [
                'required',
                'string',
            ],
        ]);

        $usuario = Usuario::query()
            ->where('usuario', $datos['usuario'])
            ->where('estado', true)
            ->first();

        if (
            !$usuario ||
            !Hash::check(
                $datos['contrasena'],
                $usuario->contrasena
            )
        ) {
            return back()
                ->withErrors([
                    'usuario' =>
                        'El usuario o la contraseña son incorrectos.',
                ])
                ->onlyInput('usuario');
        }

        Auth::login($usuario);

        $request->session()->regenerate();

        if ($usuario->rol === 'comunario') {
            return redirect()->route('comunario.panel');
        }

        if ($usuario->rol === 'administrador') {
            return redirect()->route('dashboard');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'usuario' =>
                    'El usuario no tiene un rol válido.',
            ]);
    }

    public function cerrarSesion(
        Request $request
    ): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}