<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
$url = config('app.url');
URL::forceRootUrl($url);

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/appointment', function () {
    return view('appointment');
})->name('appointment');

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

Route::get('/medical-inventory', function () {
    return view('medical-inventory');
});

Route::get('/appointment-history', function () {
    return view('appointment-history');
})->name('appointment.history');

Route::get('/addRecord', function () {
    return view('addRecordmain');
})->name('addRecordmain');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('welcome');
    })->name('dashboard');
    
});
