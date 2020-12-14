<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'regex:/^[!-~]+$/', Rule::unique('users')->ignore(Auth::id())->whereNull('deleted_at')],
            'email' => ['required_without:twitter_token', 'max:255', Rule::unique('users')->ignore(Auth::id())->whereNull('deleted_at')->whereNotNull('email')],
            'handle_name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'camp_start_date_m' => 'nullable|integer|between:1,12',
        ];
    }

    public function attributes()
    {
        return [
			'name' => 'ユーザー名',
			'handle_name' => 'ハンドルネーム',
			'email' => 'メールアドレス',
			'password' => 'パスワード',
			'camp_start_date_m' => 'キャンプ開始月',
        ];
    }
}
