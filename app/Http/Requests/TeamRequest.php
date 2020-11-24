<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name' => 'required',
            'comment' => 'required',
            'place' => 'required',
            'manager' => 'required',
            'manager_name' => 'required',
            'manager_comment' => 'required',
            'Recruitment' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'comment.required' => 'チーム紹介文を入力してください',
            'place.required' => '活動場所を入力してください',
            'manager.required' => '代表者を入力してください',
            'manager_name.required' => '代表者名を入力してください',
            'manager_comment.required' => '代表者のコメントを入力してください',
            'Recruitment.required' => '対戦相手・選手募集についてのコメントを入力してください',
        ];
    }
}
