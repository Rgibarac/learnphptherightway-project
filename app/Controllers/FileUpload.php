<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\TransactionModel;
use App\View;
use App\Models\CsvManager;
use App\Database\Managers\Transactions;

class FileUpload
{
    public function index(): ?View
    {
        return View::make('index');
    }

    public function upload(): View
    {

        $csvManager = new CsvManager();
        $transactionsDB = new Transactions();
        $transactions = $csvManager->readFiles($_FILES["file"]);

        $transactionsDB->uploadToDB($transactions);
        return View::make('transactions', ["transactions" => $transactions, "layout" => "defaultLayout"]);
    }
}