<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use Illuminate\Support\MessageBag;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', [PeopleController::class, 'store']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
