<?php

use App\Http\Front\Pages;
use App\Http\Front\Homepage;
use Illuminate\Support\Facades\Route;

Route::get('/', [Homepage::class, 'redirectToLocalizedHomepage'])->name('homepage.redirect');

Route::name('front.')
    ->prefix('{locale}')
    ->middleware(['http-basic-auth', 'url.slash'])
    ->where(['locale' => locales()->join('|')])
    ->group(function () {
        Route::get('/', [Homepage::class, 'index'])->name('homepage');

        Route::get('/pages/{slug}', [Pages::class, 'show'])->name('pages.show');
    });
