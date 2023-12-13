<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMemberRequest extends FormRequest
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
                'email' => ['required', 'email', 'unique:members,email', 'email:rfc,dns'],
                'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
                'name.required' => 'The Member Name is required.',
                'name.max' => 'The Member Name must not exceed 255 characters.',
                'email.required' => 'The Member Email is required.',
                'email.email' => 'The Member Email must be a valid email address.',
                'email.unique' => 'The Member Email already exist.',
                'contact.required' => 'The Member Contact is required.',
                'contact.regex' => 'The Member Contact must be a valid number.',
                'contact.min' => 'The Member Contact must be at least 10 characters.',
                'contact.max' => 'The Member Contact must not be greater than 10 numbers.',
        ];
    }
}