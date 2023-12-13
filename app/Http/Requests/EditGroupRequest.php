<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGroupRequest extends FormRequest
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
                'name' => ['required', 'max:255'],
                'description' => ['required', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
                'name.required' => 'The Group Name is required.',
                'name.max' => 'The Group Name must not exceed 255 characters.',
                'description.required' => 'The Group Description is required.',
                'description.max' => 'The Group Description must not exceed 255 characters.',
        ];
    }
}
