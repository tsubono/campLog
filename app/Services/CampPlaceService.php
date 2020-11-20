<?php

namespace App\Services;

class CampPlaceService
{
    /**
     * CSV用の項目ラベルを取得する
     *
     * @return array
     */
    public function getCsvColumnLabels()
    {
        return [
            'キャンプ場名',
            '住所',
            '駐車場',
            '営業時間',
            '定休日',
            'チェックイン',
            'チェックアウト',
            'カード決済',
            '利用タイプ',
//            'URL',
//            '電話番号',
            '掲載URL',
            'エラー',
        ];
    }

    /**
     * CSV用の項目keyを取得する
     *
     * @return array
     */
    public function getCsvColumns()
    {
        return [
            'name',
            'address',
            'parking',
            'business_hours',
            'holiday',
            'check_in',
            'check_out',
            'can_credit',
            'usage_type',
//            'url',
//            'tel_number',
            'base_url',
            'error',
        ];
    }
}
