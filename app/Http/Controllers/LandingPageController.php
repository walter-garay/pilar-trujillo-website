<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        return Inertia::render('LandingPage');
    }

    /**
     * Process the contact form submission.
     */
    public function contact(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'ciudad' => 'nullable|string|max:255',
            'tipo_consulta' => 'required|string|in:general,servicios,soporte,otro',
            'mensaje' => 'required|string|max:1000',
            'acepta_terminos' => 'required|accepted',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'tipo_consulta.required' => 'Debes seleccionar un tipo de consulta.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'acepta_terminos.required' => 'Debes aceptar los términos y condiciones.',
            'acepta_terminos.accepted' => 'Debes aceptar los términos y condiciones.',
        ]);

        try {
            // Aquí puedes agregar la lógica para procesar el formulario
            // Por ejemplo, enviar un email, guardar en base de datos, etc.

            // Ejemplo: Log del formulario (para desarrollo)
            Log::info('Formulario de contacto recibido', $validated);

            // Ejemplo: Enviar email (descomenta si tienes configurado el email)
            // Mail::to('admin@example.com')->send(new ContactFormMail($validated));

            return back()->with('success', '¡Mensaje enviado exitosamente! Nos pondremos en contacto contigo pronto.');

        } catch (\Exception $e) {
            Log::error('Error al procesar formulario de contacto: ' . $e->getMessage());

            return back()->withErrors([
                'error' => 'Hubo un error al enviar el mensaje. Por favor, intenta nuevamente.'
            ]);
        }
    }
}
