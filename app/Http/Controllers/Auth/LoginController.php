<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verifica si el correo electrónico está registrado
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withInput($request->only('email'))->withErrors([
                'email' => 'Este correo electrónico no está registrado.',
            ]);
        }

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Estas credenciales no coinciden con nuestros registros.',
        ]);
    }

    protected function redirectTo()
    {
        return '/dashboard'; // Ajusta la ruta según tus necesidades
    }


    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('pagina_principal');
    }
}
