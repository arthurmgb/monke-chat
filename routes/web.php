<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\TarefaComponent;


Route::group(['middleware' => 'auth'], function(){

    Route::get('/', TarefaComponent::class)->name('home');
    
    Route::get('/optimize', function() {
        Artisan::call('optimize:clear');
        return '<h1>All caches cleared!</h1>';
    });

});
