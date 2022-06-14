<?php

declare(strict_types=1);

namespace App\Models;


use App\Exceptions\EmptyFileException;
use App\Exceptions\InvalidFileContentsException;
use App\Exceptions\UnsupportedFileExtensionException;
use App\Exceptions\UploadException;
use App\Model;


class CsvManager extends Model
{

    public function readFiles(array $filePaths): array
    {

        $contents = [];

        foreach ($filePaths["tmp_name"] as $each_tmp_name) {
            $content = $this->readFile($each_tmp_name);
            $contents = array_merge($content, $contents);
        }


        echo "<br/>";

        return $contents;
    }

    private function readFile(string $filePath): array
    {
        $content = [];
        $file = fopen($filePath, 'r');
        if ($file !== FALSE) {
            while (!feof($file)) {
                $currentline = fgetcsv($file);
                if (is_array($currentline)) {
                    if ($currentline[0] != "Date") {
                        array_push($content, $currentline);
                    }
                }

            }
        }
        fclose($file);

        return $content;
    }


}