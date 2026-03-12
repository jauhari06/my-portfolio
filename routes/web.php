<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/project/{id}', function ($id) {
    return view('project-detail', ['id' => $id]);
})->name('project.detail');