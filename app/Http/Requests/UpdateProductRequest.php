<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'supplier_id' => 'sometimes|numeric|min:1',
            'short_code' => 'sometimes|string|max:6|nullable',
            'name' => 'sometimes|string|max:255',
            'short_description' => 'sometimes|string|max:1024|nullable',
            'status' => 'sometimes|string|max:20',
        ];
    }
}
