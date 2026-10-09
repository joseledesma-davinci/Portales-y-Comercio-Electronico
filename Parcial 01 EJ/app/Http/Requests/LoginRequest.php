<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request de validación para el login del panel admin.
 */
class LoginRequest extends FormRequest
{
    /**
     * Autoriza la solicitud de login.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación del formulario de acceso.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    /**
     * Mensajes personalizados de error en español.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Che, ingresá tu email para continuar.',
            'email.email' => 'El email no tiene un formato válido.',
            'password.required' => 'Necesitás ingresar tu contraseña.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
        ];
    }
}
