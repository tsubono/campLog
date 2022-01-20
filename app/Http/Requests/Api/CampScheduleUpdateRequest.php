<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CampScheduleUpdateRequest extends FormRequest
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
            'camp_place_id' => 'nullable|integer',
            'date' => 'nullable|date',
            'review' => 'max:3000',
            'note' => 'max:3000',
        ];
    }

    /**
     * @return string[]
     */
    public function attributes()
    {
        return [
            'camp_place_id' => 'キャンプ場',
            'date' => '日付',
            'review' => '口コミ',
            'note' => 'メモ',
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
