<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//href
Route::get('registrazione', "RegistrazioneController@index");
Route::get('login', "LoginController@index");
Route::get('AboutUs', "AboutUsController@index");
Route::get('doveSiamo', "doveSiamoController@index");
Route::get('products', "productsController@index");
Route::get('scattaConNoi', "scattaConNoiController@index");
Route::get('managementArea', "managementAreaController@index");
Route::get('userArea', "userAreaController@index");

//fetch
Route::get('doveSiamo/Negozio', "doveSiamoController@negozio");

Route::get('registrazione/email/{q}', "RegistrazioneController@email");
Route::get('registrazione/username/{q}', "RegistrazioneController@username");
Route::post('registrazione', "RegistrazioneController@Registrazione");

Route::post("login", "LoginController@login");
Route::get("login/logcheck", "LoginController@logcheck");
Route::get('login/logout', "LoginController@logout");

Route::get('userArea/removeCart/{id}', "userAreaController@removeCart");
Route::get('userArea/addOrder/{stampa}', "userAreaController@addOrder");
Route::get('userArea/addRec/{voto}/{testo}/{acquisto}', "userAreaController@addRec");
Route::get('userArea/addCart/{stampa}', "userAreaController@addCart");
Route::get('userArea/removePref/{id}', "userAreaController@removePref");
Route::get('userArea/recensioni', "userAreaController@recensioni");
Route::get('userArea/carrello', "userAreaController@carrello");
Route::get('userArea/ordini', "userAreaController@ordini");
Route::get('userArea/user', "userAreaController@user");
Route::get('userArea/preferiti', "userAreaController@preferiti");

Route::get('managementArea/dati/{type}', 'managementAreaController@dati');
Route::get('managementArea/addStampa/{altezza}/{larghezza}/{materiale}/{prezzo}/{foto}', 'managementAreaController@addStampa');
Route::get('managementArea/removeFotografo/{CF}', 'managementAreaController@removeFotografo');
Route::get('managementArea/removeFoto/{ID}', 'managementAreaController@removeFoto');
Route::get('managementArea/removeStampa/{ID}', 'managementAreaController@removeStampa');
Route::post('managementArea/addFotografo', 'managementAreaController@addFotografo');
Route::post('managementArea/addFoto', 'managementAreaController@addFoto');

Route::get('products/stampe/{id}', "productsController@stampe");
Route::get('products/foto', "productsController@foto");
Route::get('products/addCarrello/{stampa}', "productsController@addCarrello");
Route::get('products/addSalvato/{stampa}', "productsController@addSalvato");
Route::get('products/recensioni/{foto}', "productsController@recensioni");

Route::get('scattaConNoi/IPGeolocation/{luogo}/{data}', "scattaConNoiController@IPGeolocation");

Route::get('doveSiamo/info', "doveSiamoController@info");

Route::get('AboutUs/fotografi', "AboutUsController@fotografi");
Route::get('AboutUs/playlist/{id}', "AboutUsController@playlist");