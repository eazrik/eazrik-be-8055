<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:2048'],
            'genre' => ['required'],
            'performer' => ['required'],
            'director' => ['required'],
            'theater_name' => ['required'],
            'release' => ['required'],
            'start_at' => ['required'],
            'end_at' => ['required'],
            'length' => ['required'],
        ];
    }

    /**
     * messages function
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required'  => 'Please write Your title',
            'description.required'  => 'Please write movie synopsis',
            'image.required'     => 'Please Upload image',
            'genre.required' => 'Please write Your Genre',
            'performer.required' => 'Please write Movie actor',
            'director.required' => 'Please write Movie director',
            'theater_name.required' => 'Please write Movie theater_name',
            'release.required' => 'Please write Movie release',
            'start_at.required' => 'Please write Movie start_at',
            'end_at.required' => 'Please write Movie end_at',
            'length.required' => 'Please write Movie length',
        ];
    }
}
