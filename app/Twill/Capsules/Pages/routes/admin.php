<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'global'], function () {
    Route::module('pages');
});
