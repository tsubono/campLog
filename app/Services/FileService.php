<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class FileService
{
    /**
     * CSV読み込み
     *
     * @param $csv
     * @param $dir
     * @param $columns
     * @param $columnLabels
     * @return array | boolean
     */
    public function loadCsv($csv, $dir, $columnLabels, $columns)
    {
        $csvArray = [];
        $temporary = $csv->store($dir);
        $file = new \SplFileObject(storage_path('app/') . $temporary);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $headers = $file->fgetcsv();
        mb_convert_variables('UTF-8', 'sjis-win', $headers);

        foreach ($file as $rowIndex => $row) {
            // 文字コードを UTF-8 へ変換
            mb_convert_variables('UTF-8', 'sjis-win', $row);

            if ($rowIndex === 0) {
                continue;
            }

            foreach ($headers as $headerIndex => $column_name) {
                $csvArray[$rowIndex][$columns[$headerIndex]] = $row[$headerIndex] ?? '';
            }
        }

        return $csvArray;
    }
}
