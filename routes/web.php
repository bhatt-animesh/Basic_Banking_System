<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BankController@index');
Route::get('/customers', 'BankController@customer');
Route::get('/transfer', 'BankController@transfer');
Route::post('/transfer/amount', 'BankController@transferamount');
Route::get('/transactionhistorys', 'BankController@transactionhistorys');