<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'regex:/^[!-~]+$/', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'email' => ['required_without:twitter_token', 'string', 'email', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'password' => ['required_without:twitter_token', 'string', 'min:8'],
            'twitter_token' => ['required_without:email', 'string', Rule::unique('users')->whereNull('deleted_at')],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
			'name' => 'ユーザー名',
			'email' => 'メールアドレス',
			'password' => 'パスワード',
			'twitter_token' => 'Twitterトークン',
        ];
    }

    /**
     * バリデーション失敗時
     *
     * @param Validator $validator
     * @return void
     * @throw HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json($validator->errors()->toArray() +
                ['code' => 422, 'error_message' => '入力内容が不正です'], 422)
        );
    }
}
