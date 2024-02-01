<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;


    public function __construct()
    {
        $this->middleware('guest');
    }

    // Muestra el formulario de restablecimiento de contraseña
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // Redirigir según la respuesta
        if ($response == Password::PASSWORD_RESET) {
            auth()->logout(); // Cierra la sesión
            return redirect()->route('login')->with('status', trans($response));
        }

        // Si hubo algún problema, regresa con errores
        return back()->withErrors(['email' => trans($response)]);
    }

}
