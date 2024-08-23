<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScraperController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')
    ->name('dashboard.')
    ->controller(DashboardController::class)
    ->group(function() {
        Route::get('/', 'INDEX')->name('index');  
    });

Route::prefix('/scraper')
    ->name('scraper.')
    ->controller(ScraperController::class)
    ->group(function() {
        Route::get('/bela', 'BELA_INDEX')->name('bela.index'); 
        Route::get('/bela/scrape', 'BELA_SCRAPE')->name('bela.scrape'); 
    });
