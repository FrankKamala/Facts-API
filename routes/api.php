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
        'transaction' => 'Api\TransactionController'
    ]);

    Route::post('invoice/update/{id}', 'Api\InvoiceController@update');
});
