<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/membres', function () {
    return view('membres.membres');
})->name('membres');

Route::get('/activites', function () {
    return view('activites.activites');
})->name('activites');

Route::get('/epargnes', function () {
    return view('epargnes.epargnes');
})->name('epargnes');

Route::get('/cotisations', function () {
    return view('cotisations.cotisations');
})->name('cotisations');

Route::get('/parametres', function () {
    return view('parametres.parametres');
})->name('parametres');

Route::get('/prets', function () {
    return view('prets.prets');
})->name('prets');

Route::get('/rapports', function () {
    return view('rapports.rapports');
})->name('rapports');

Route::get('/tontines', function () {
    return view('tontines.tontines');
})->name('tontines');
