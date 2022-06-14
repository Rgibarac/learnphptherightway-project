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
    public function readFile(array $filePaths): array
    {

        $contents = [];

        foreach ($filePaths["tmp_name"] as $each_tmp_name) {
            $file = fopen($each_tmp_name, 'r');
            if ($file !== FALSE) {
                while (!feof($file)) {
                    $content = fgetcsv($file);
                    if (is_array($content)) {
                        if ($content[0] != "Date") {
                            array_push($contents, $content);
                        }
                    }

                }
            }
        }


        fclose($file);

        echo "<br/>";

        return $contents;
    }

    public function uploadToDB(array $transactions): bool
    {
        $query = "INSERT INTO transactions (date, check_number, description, amount) VALUES (?, ?, ?, ?);";
        $statement = $this->db->prepare($query);

        foreach ($transactions as $transaction) {
            $transactionDB = array(
                "date" => $transaction[0],
                "check_number" => $transaction[1],
                "description" => $transaction[2],
                "amount" => (float)(str_replace(",", "", (str_replace("$", "", $transaction[3]))))
            );
            $statement->execute(array_values($transactionDB));

        }


        return true;
    }


}