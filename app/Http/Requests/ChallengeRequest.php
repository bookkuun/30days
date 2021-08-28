<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends FormRequest
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
            'challenge_title' => ['required', 'max:200'],
            'start_day' => ['required', 'after:yesterday'],
        ];
    }

    public function attributes()
    {
        return [
            'challenge_title' => 'Challenge',
            'start_day' => '始める日',
        ];
    }

    public function messages()
    {
        return [
            'challenge_title.required' => ":attributeを入力してください",
            'challenge_title.max' => ":attributeは100文字以内で入力してください",
            'start_day.required' => ':attributeを入力してください',
            'start_day.after' => ':attributeは今日以降の日付を入力してください',
        ];
    }
}
