<?php

use App\Livewire\Users\UserList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', UserList::class)->name('users.index');
Route::get('create-user', \App\Livewire\Users\CreateUser::class)->name('users.create');
Route::get('/users/{userId}/edit', \App\Livewire\Users\CreateUser::class)->name('users.edit');
