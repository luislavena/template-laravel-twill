<?php

use App\Http\Front\Pages;
use App\Http\Front\Homepage;
use Illuminate\Support\Facades\Route;

Route::get('/', [Homepage::class, 'redirectToLocalizedHomepage'])->name('homepage.redirect');

Route::group(
    [
        'prefix' => '{locale}',
        'name' => 'front',
        'middleware' => ['auth.very_basic', 'url.slash'],
        'where' => ['locale' => locales()->join('|')],
    ],
    function () {
        Route::get('/', [Homepage::class, 'index'])->name('homepage');

        Route::get('/pages/{slug}', [Pages::class, 'show'])->name('pages.show');
    },
);
