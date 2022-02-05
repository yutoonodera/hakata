<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_file' => 'required|file|mimes:mov,mp4',
            'thumbnail_file' => 'file|mimes:jpg,png',
        ];
    }

    public function attributes()
    {
        return [
            'thumbnail_file' => 'サムネイル',
            'movie_file' => '動画',
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
