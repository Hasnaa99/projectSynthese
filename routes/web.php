<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotationController;
use App\Http\Controllers\StagiaireController;
use Illuminate\Support\Facades\Route;

//Route de la page acceuil
Route::get('/',[GroupeController::class,'index'])->name('acceuil')->middleware('auth');

//Route de connexion
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'show'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
//Route de déconnexion
Route::get('/logout',[AuthController::class,'logout'])->middleware('auth');
//Formateur
Route::get('formateurCompte',[FormateurController::class,'index'])->name('formateur');
Route::patch('formateur/update/{formateurId}',[FormateurController::class,'update'])->name('formateur.update');
//modules
Route::get('/groupe/{groupe}/module/{module}', [ModuleController::class, 'show'])->name('module.show');
//RechercheStagiaire
Route::get('/rechercher_stagiaire',[StagiaireController::class,'rechercher_stagiaire'])->name('stagiaires.rechercher');
//Evaluation
Route::get('/create_evaluation/groupe/{groupe_id}/module/{module_id}',[ModuleController::class,'create_evaluation'])->name('create_evaluation');
Route::post('/store_evaluation',[ModuleController::class,'store_evaluation'])->name('store_evaluation');
//Notation
Route::post('/save-notes', [NotationController::class, 'saveNotes'])->name('save_notes');