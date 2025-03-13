<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\EpargnesController;
use App\Http\Controllers\TontineController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('membres', MembreController::class);

// Epargnes Routes
Route::resource('epargnes', EpargnesController::class);
Route::get('epargnes/{epargne}/details', [EpargnesController::class, 'details'])->name('epargnes.details');

Route::get('/activites', function () {
    return view('activites.activites');
})->name('activites');

// Route::get('/epargnes', function () {
//     return view('epargnes.epargnes');
// })->name('epargnes');

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

// Tontines Routes
Route::get('/tontines', [TontineController::class, 'index'])->name('tontines.index');
Route::resource('tontines', TontineController::class)->except(['index']);
Route::post('/tontines/{tontine}/add-participant', [TontineController::class, 'addParticipant'])->name('tontines.add-participant');
Route::delete('/tontines/{tontine}/remove-participant/{user}', [TontineController::class, 'removeParticipant'])->name('tontines.remove-participant');
Route::post('/tontines/{tontine}/add-contribution', [TontineController::class, 'addContribution'])->name('tontines.add-contribution');
