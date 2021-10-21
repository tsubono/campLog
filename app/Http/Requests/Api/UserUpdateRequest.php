<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => ['nullable', 'min:1', 'max:255', 'regex:/^[!-~]+$/', Rule::unique('users')->ignore(request()->user()->id)->whereNull('deleted_at')],
            'email' => ['nullable', 'string', 'email', 'min:1', 'max:255', Rule::unique('users')->ignore(request()->user()->id)->whereNull('deleted_at')],
            'password' => ['nullable', 'string', 'min:8'],
            'handle_name' => ['nullable', 'string', 'min:1', 'max:255'],
            'camp_start_date_m' => ['nullable', 'integer', 'between:1,12'],
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
            'handle_name' => 'ハンドルネーム',
            'camp_start_date_m' => 'キャンプ開始月',
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
