<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('index.contacto');
    }
    public function submitContactForm(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required'
        ]);

        // Datos del formulario
        $data = [
            'nombre' => $request->input('nombre'),
            'email' => $request->input('email'),
            'mensaje' => $request->input('mensaje'),
        ];

        try {
            // Envía el correo electrónico
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($data));

            // Puedes agregar lógica adicional aquí, por ejemplo, para guardar en la base de datos.

            return redirect()->route('contact.show')->with('status', 'Enviado Correctamente.');
        } catch (\Exception $e) {
            // Manejar errores, por ejemplo, registrar el error o redirigir a una página de error.
            return redirect()->route('contact.show')->with('error', 'Error al enviar el correo electrónico.');
        }
    }
}
