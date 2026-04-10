<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardContoller;
use App\Http\Controllers\DataOrangContoller;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardContoller::class, 'index']);
Route::get('/api/dashboard/data', [DashboardContoller::class, 'getDashboardData']);
Route::get('/manajemen_data', [DataOrangContoller::class, 'index']);
Route::get('/manajemen_data/search-ajax', [DataOrangContoller::class, 'searchAjax']);
Route::get('/manajemen_data/sync-data', [DataOrangContoller::class, 'syncData']);
Route::post('/manajemen_data/store', [DataOrangContoller::class, 'store']);
Route::get('/manajemen_data/edit/{id}',[DataOrangContoller::class, 'edit']);  
Route::put('/manajemen_data/update/{id}', [DataOrangContoller::class, 'update']);
Route::get('/manajemen_data/delete/{id}', [DataOrangContoller::class, 'destroy']);

