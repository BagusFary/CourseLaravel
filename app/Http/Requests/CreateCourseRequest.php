<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:30',
            'description' => 'required|max:255',
            'thumbnail' =>  ['required', File::image()->max(5000)],
            'video' => ['required', File::types(['mp4','avi'])->max(100000)],
            'price' => 'required|integer'
        ];
    }
}
