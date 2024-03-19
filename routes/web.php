<?php

use App\Http\Controllers\Companycontroller;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/adduser', function () {
    return view('adduser');
});

Route::get('/listing', function () {
    return view('listing');
});

Route::post('/add',[Companycontroller::class,'add']);

Route::get('/list',[Companycontroller::class,'list']);

Route::post('/update-admin-status',[Companycontroller::class,'updateAdminStatus'])->name('updateAdminStatus');

Route::get('/edit',[Companycontroller::class,'edit']);

Route::post('/delete',[Companycontroller::class,'delete']);

Route::get('/display-data',[Companycontroller::class,'displayData'])->name('displayData');

Route::get('/getmanageroptions',[Companycontroller::class,'getmanageroptions']);