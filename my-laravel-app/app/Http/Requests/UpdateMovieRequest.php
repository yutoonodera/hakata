<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
            'movie_file' => 'file|mimes:mov,mp4',
            'thumbnail_file' => 'file|mimes:jpg,png',
            'title' => 'required|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'minutes' => 'required',
            'price1' => 'integer',
            'price2' => 'integer',
        ];
    }

    public function attributes()
    {
        return [
            'thumbnail_file' => 'サムネイル',
            'movie_file' => '動画',
            'title' => 'タイトル',
            'start_date' => '公開開始',
            'end_date' => '公開終了',
            'minutes' => '時間',
            'price1' => '価格',
            'price2' => '価格',
        ];
    }

    public function messages()
    {
        return [
            'start_date.after_or_equal' => ':attributeには今日以降の日付を入力してください。',
            'end_date.after_or_equal' => ':attributeには公開開始以降の日付を入力してください。',
        ];
    }
}
