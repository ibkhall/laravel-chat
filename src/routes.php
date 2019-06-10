<?php

use Illuminate\Support\Facades\Route;

Route::get(config('khall_chat.route'), 'Khall\Chat\ConversationController@index');
Route::get(config('khall_chat.route').'/{user}', 'Khall\Chat\ConversationController@show')
    ->name('chat.show');
Route::post(config('khall_chat.route').'/{user}', 'Khall\Chat\ConversationController@store'); //->middleware('can:talkTo,user')
