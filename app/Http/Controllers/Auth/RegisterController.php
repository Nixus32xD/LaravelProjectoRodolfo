<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\VerifiesEmails;


class RegisterController extends Controller
{
    use RegistersUsers, VerifiesEmails;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users',Rule::unique('usuarios', 'email')], // Añade esta regla de validación única//,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['name'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    protected function registered(Request $request, $user)
    {
        // Agrega la lógica para redirigir al usuario a la página de verificación
        return redirect(route('verification.notice'));
    }
}
