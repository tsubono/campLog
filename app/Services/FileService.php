<?php

namespace App\Services;

class FileService
{
    /**
     * CSV読み込み
     *
     * @param [type] $csv
     * @param [type] $dir
     * @param [type] $columnLabels
     * @param array $columns
     * @return void
     */
    public function loadCsv($csv, $dir, $columnLabels, array $columns)
    {
        $temporary = $csv->store($dir);

        $csv_path = storage_path('app/') . $temporary;
        $this->sjisToUtf8($csv_path);

        return $this->parseCsv($csv_path, $columns);
    }

    /**
     * sjisToUtf8
     *
     * CSVの文字コードをUTF8にする
     *
     * @param string $csv_path
     * @return void
     */
    public function sjisToUtf8(string $csv_path): void
    {
        $sjis = file_get_contents($csv_path);
        $utf8 = mb_convert_encoding($sjis, 'UTF-8', 'SJIS-win');
        file_put_contents($csv_path, $utf8);
    }

    /**
     * 読み込んだCSVをDB登録用にパースする
     *
     * @param string $csv_path
     * @param array $columns
     * @return array
     */
    public function parseCsv(string $csv_path, array $columns): array
    {
        $file = new \SplFileObject($csv_path);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        $headers = $file->fgetcsv();

        foreach ($file as $rowIndex => $row) {
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
