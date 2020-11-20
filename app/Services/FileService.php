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
        $fp = fopen(storage_path('app/') . $temporary, 'r');
        $headers = fgetcsv($fp);

        $i = 0;
        while ($row = fgetcsv($fp)) {
            mb_convert_variables('UTF-8', 'SJIS-win', $row);
            foreach ($headers as $index => $column_name) {
                if (!isset($row[$index])) {
                    Log::info($index);
                    $csvArray = false;
                    break;
                }
                $csvArray[$i][$columns[$index]] = $row[$index];
            }
            $i++;
        }

        return $csvArray;
    }
}
