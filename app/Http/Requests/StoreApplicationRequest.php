<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'contact_email' => 'required|email|unique:applications,contact_email',
            'contact_phone' => ['required', 'regex:/^\+?\d{8,15}$/', 'unique:applications,contact_phone'],
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female',
            'country' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'files' => 'nullable|array|max:10',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,pdf|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'contact_phone.phone' => 'Please provide a valid international phone number (E.164).',
            'contact_email.required' => 'Email is required.',
            'contact_email.email' => 'Enter a valid email address.',
            'date_of_birth.required' => 'Date of birth is required.',
            'date_of_birth.before' => 'Date of birth must be before today.',
            'gender.required' => 'Please select your gender.',
            'country.required' => 'Country is required.',
            'files.*.mimes' => 'Only JPG, PNG, GIF or PDF files are allowed.',
            'files.*.max' => 'Each file must not exceed 5MB.',
        ];
    }
}
