<?php

// app/Http/Controllers/Auth/VerificationController.php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;


class VerificationController extends Controller
{
    use VerifiesEmails;

    // Esta propiedad define la ruta a la que se redirige después de la verificación del correo electrónico.
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // Método para mostrar la vista de verificación de correo electrónico.
    public function show(Request $request)
    {
        return view('auth.verify');
    }

    // Método para manejar el envío de la notificación de verificación de correo electrónico.
    public function resend(Request $request)
    {
        // Verifica si el usuario aún no ha verificado su dirección de correo electrónico.
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        // Envía la notificación de verificación de correo electrónico.
        $request->user()->sendEmailVerificationNotification();

        // Devuelve una respuesta a la vista.
        return back()->with('resent', true);
    }

    public function verify(Request $request, $id, $hash)
    {
        $user = User::find($id);

        if (!$user || !hash_equals($hash, sha1($user->getEmailForVerification()))) {
            // Si no se encuentra el usuario o el hash no coincide, puedes manejar el error aquí.
            // Por ejemplo, podrías redirigir a una página de error.
            return redirect('/error');
        }

        if ($user->hasVerifiedEmail()) {
            // Si el usuario ya ha verificado su correo electrónico, puedes redirigirlo a donde quieras.
            return redirect('/already-verified');
        }

        $user->markEmailAsVerified();

        event(new Verified($user));

        // Lógica adicional después de la verificación si es necesario

        return view('auth.verified');
    }

    // Método para redirigir después de la verificación del correo electrónico.
    protected function redirectTo()
    {
        return $this->redirectTo;
    }
}
