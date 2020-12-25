<?php

use Illuminate\Support\Facades\Route;

Route::get('/butylogs', [\hamedsz\butylog\controllers\ButyLogController::class , "main"])->name('buty.main');
Route::get('/butylogs/{url}', [\hamedsz\butylog\controllers\ButyLogController::class , "url"])->name('buty.url');
Route::get('/butylogs/{url}/{name}', [\hamedsz\butylog\controllers\ButyLogController::class , "log"])->name('buty.log');
