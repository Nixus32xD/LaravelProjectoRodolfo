<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Muestra el formulario de solicitud de restablecimiento de contraseña
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }
}
