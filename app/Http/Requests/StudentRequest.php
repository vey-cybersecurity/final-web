<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $studentId = $this->route('student')?->id ?? $this->route('student');

        return [
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'student_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_code')->ignore($studentId),
            ],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', Rule::in(['Male', 'Female'])],
            'dob' => ['required', 'date', 'before_or_equal:today'],
            'phone' => ['nullable', 'string', 'max:30'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'remove_photo' => ['nullable', 'boolean'],
        ];
    }
}
