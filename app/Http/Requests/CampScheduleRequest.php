<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampScheduleRequest extends FormRequest
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
            'camp_place_id' => 'required',
            'date' => 'required|date',
            'note' => 'max:700',
        ];
    }

    public function attributes()
    {
        return [
			'camp_place_id' => 'キャンプ場',
			'date' => '日付',
			'note' => '備考',
        ];
    }
}
