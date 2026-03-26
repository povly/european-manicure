<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');
