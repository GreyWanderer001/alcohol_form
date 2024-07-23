<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;

Route::get('/', [RecordController::class, 'index'])->name('record.index');
Route::post('/fetch', [RecordController::class, 'fetch'])->name('record.fetch');
Route::put('/update/{REQUEST_ID}', [RecordController::class, 'update'])->name('record.update');
