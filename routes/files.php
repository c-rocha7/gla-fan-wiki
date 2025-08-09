<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('files')->group(function () {
    Route::post('/upload', [FileUploadController::class, 'upload'])->name('files.upload');
    Route::get('/list', [FileUploadController::class, 'list'])->name('files.list');
    Route::get('/download/{filePath}', [FileUploadController::class, 'download'])->name('files.download')->where('filePath', '.*');
    Route::delete('/delete/{filePath}', [FileUploadController::class, 'delete'])->name('files.delete')->where('filePath', '.*');
});
