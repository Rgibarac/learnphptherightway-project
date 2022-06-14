<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\TransactionModel;
use App\View;
use App\Models\CsvManager;

class FileUpload
{
    public function index(): ?View
    {
        return View::make('index');
    }

    public function upload(): View
    {

        $csvManager = new CsvManager();
        $transactions = $csvManager->readFile($_FILES["file"]);

        $csvManager->uploadToDB($transactions);
        return View::make('transactions', ["transactions" => $transactions, "layout" => "defaultLayout"]);
    }
}