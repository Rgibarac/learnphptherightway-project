<?php

declare(strict_types=1);

namespace App\Database\Managers;

use App\Model;

class Transactions extends Model
{


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