<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InvoiceStatus;
use App\Models\TransactionType;
use Illuminate\Http\Request;

class OptionsController extends Controller
{
    public function invoice_status() {
        return InvoiceStatus::all();
    }

    public function transaction_type() {
        return TransactionType::all();
    }
}
