<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pages'], function () {
    Route::module('pages');
});
