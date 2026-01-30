<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrutasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fruta' => 'required|min:4|max:10|string|in:pera,manzana,banana',
            'descripcion' => 'required|max:20',
            'pais' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'fruta.required' => 'La fruta es obligatoria',
            'fruta.min' => 'La fruta debe tener al menos 4 caracteres',
            'fruta.max' => 'La fruta debe tener menos de 10 caracteres',
            'fruta.string' => 'La fruta debe ser un string',
            'fruta.in' => 'La fruta debe ser pera, manzana o banana',
            'descripcion.required' => 'La descripcion es obligatoria',
            'descripcion.max' => 'La descripcion debe tener menos de 20 caracteres',
            'pais.required' => 'El pais es obligatorio',
        ];
    }
}
