<?php

Route::group(['prefix' => 'pm', 'as' => 'pm.', 'middleware' => 'web'], function () {
    // Inbox
    Route::get('/inbox', ['as' => 'inbox', 'uses' => 'LaravelPM\Http\Controllers\PMController@inbox']);

    // Read conversation
    Route::get('/read/{conversation}', ['as' => 'read', 'uses' => 'LaravelPM\Http\Controllers\PMController@read']);

    // Compose
    Route::any('/compose', ['as' => 'compose', 'uses' => 'LaravelPM\Http\Controllers\PMController@compose']);
});
