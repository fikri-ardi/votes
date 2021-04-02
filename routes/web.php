<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/polls');
});

Route::middleware('auth')->group(function(){
    Route::get('/change-password','Auth\ChangePasswordController@index')->name('password.change');
    Route::patch('/change-password','Auth\ChangePasswordController@store')->name('password.store');

    Route::resource('polls','PollController');
    Route::post('votes/{poll}/{choice}','VoteController')->name('votes.store');
});

require __DIR__.'/auth.php';
