<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
$url = config('app.url');
URL::forceRootUrl($url);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/appointment', function () {
    return view('appointment');
});

Route::get('/adminboard', function () {
    return view('adminboard');
});

Route::get('/inventoryrec', function () {
    return view('inventoryrec');
});

Route::get('/medrecords', function () {
    return view('medrecords');
});

Route::get('/summaryreport', function () {
    return view('summaryreport');
});

Route::get('/calendar', function () {
    return view('calendar');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
