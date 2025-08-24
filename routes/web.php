<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('proof/download/{file_path}', [FileController::class, 'downloadFile'])
->name('download.file')
->where('file_path', '.*');

Route::get('proof/view/{file_path}', [FileController::class, 'viewFile'])
->name('view.file')
->where('file_path', '.*');

Route::get('/{any}', fn () => view('welcome'))->where('any', '.*');


