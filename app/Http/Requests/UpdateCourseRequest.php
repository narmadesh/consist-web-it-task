<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'instructor' => 'required'
        ];
    }

    public function process()
    {
        $course = $this->route('course')->update(['title' => $this->title, 'description' => $this->description]);
        return $this->route('course')->instructor()->update(['instructor_id' => $this->instructor]);
    }
}
