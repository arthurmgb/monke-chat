<?php

use App\Http\Livewire\Mensagem;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TarefaComponent;


Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', TarefaComponent::class)->name('home');

    Route::get('/', Mensagem::class)->name('chat');
    
});

Route::get('/opt', function() {
    Artisan::call('optimize');
    return "Cleared";
});