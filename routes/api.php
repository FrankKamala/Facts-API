<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::middleware(['auth:api'])->group(function() {
    Route::resources([
        'user' => 'Api\UserController',
        'invoice' => 'Api\InvoiceController',
        'transaction' => 'Api\TransactionController',
        'account' => 'Api\AccountController'
    ]);
    Route::get('supplier/buyers', 'Api\InvoiceController@buyers');

    Route::get('buyer/suppliers', 'Api\InvoiceController@suppliers');

    Route::get('supplier/invoices', 'Api\InvoiceController@supplierInvoices');

    Route::get('supplier/invoices/approved', 'Api\InvoiceController@supplierApproved');

    Route::get('buyer/invoices/approved', 'Api\InvoiceController@buyerApproved');

    Route::get('buyer/invoices', 'Api\InvoiceController@buyerInvoices');

    Route::post('invoice/update/{id}', 'Api\InvoiceController@update');

    Route::get('user/{id}/invoices/approved', 'Api\InvoiceController@approved');



});
Route::get('options/invoice', 'Api\OptionsController@invoice_status');
Route::get('options/transaction', 'Api\OptionsController@transaction_type');
Route::get('users/all', 'Api\UserController@all');
Route::get('users/buyers', 'Api\UserController@buyers');
Route::get('users/suppliers', 'Api\UserController@suppliers');