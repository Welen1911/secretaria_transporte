<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoMobileRequest extends FormRequest
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
            'year' => 'required|string|max:4',
            'plate' => 'required|string|max:7',
            'model' => 'required|string',
            'capacity' => 'required|integer',
        ];
    }
}
