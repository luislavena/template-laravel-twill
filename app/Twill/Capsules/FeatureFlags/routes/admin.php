<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'config'], function () {
    Route::module('featureFlags');
});
