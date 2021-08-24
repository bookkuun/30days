<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
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
            'diary_comment' => ['required', 'max:1000'],
        ];
    }

    public function attributes()
    {
        return [
            'diary_comment' => '1日の振り返り',
        ];
    }

    public function messages()
    {
        return [
            'diary_comment.required' => ":attributeを入力してください",
            'diary_comment.max' => ":attributeは1000文字以内で入力してください",
        ];
    }
}
