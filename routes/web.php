<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Auth\LoginController;


/* Rotta Home Page */
Route::get('/', 'PublicController@backHome')
    ->name('Home');

/* Rotta Catalogo con gli eventi */
Route::get('/Catalogo', 'PublicController@showCatalog')
    ->name('Catalogo');

Route::post('/Catalogo','PublicController@showCatalog')
    ->name('Catalogo');

/* Rotta Info Evento selezionato */
Route::get('/InfoEvento/{cod_evento}', 'PublicController@showEvento')
    ->name('InfoEvento');




/******* LOGIN/LOGOUT UTENTE *******/

/* Rotta Login Utente/Organizzatore/Admin */
Route::get('/loginForm', 'PublicController@showLoginForm')
    ->name('Login');

/* Rotta per la verifica di tutte le credenziali per l'accesso al sito */
Route::post('/login', 'PublicController@handleLogin');

/* Rotta Logout Sessione Utente */
Route::get('/logout', function(){
    if(session()->has('utente')){
        session()->pull('utente');
        session()->pull('nome');
        session()->pull('cognome');
        session()->pull('email');
        session()->pull('password');
        session()->pull('telefono');
        session()->pull('data_nascita');
        session()->pull('categoria');
    }
    return view('layouts/Home');
})->name('Logout');






/******* UTENTE LIVELLO 2 *******/

/* Rotta per la modifica delle credenziali dell'utente */
Route::post('/updateUser', 'PublicController@editProfile')
    ->name('ModificaProfil');

/* Rotta per la visualizzazione delle credenziali dell'utente */
Route::view('/userpage', 'user/userPage')
    ->name('userpage');

/* Rotta per la visualizzazione dei biglietti acquistati dell'utente */
Route::get('/bigliettiAcquistati','PublicController@showBigliettiAcquistati')
    ->name('bigliettiAcquistati');

/* Rotta per l'acquisto del biglietto */
Route::get('/paymentForm/{cod_evento}', 'PublicController@paymentPage')
    ->name('payment');

/* Rotta per la visualizzazione di un riepilogo del biglietto acquistato */
Route::get('/riepilogo/{cod_evento}', 'PublicController@registraOrdine')
    ->name('showRiepilogo');

/* Controlla il bottone parteciperò */
Route::get('/partecipa/{cod_evento}', 'PublicController@newPartecipazione')
    ->name('partecipa');



/******* UTENTE LIVELLO 3 *******/

/* Rotta per la visualizzazione e modifica delle credenziali dell'organizzatore */
Route::view('/organizzatorePage', 'organizer/organizzatorePage')
    ->name('organizzatorePage');

/* Rotta per la visualizzazione degli eventi dell'organizzatore */
Route::get('/eventiOrganizzatore', 'OrganizzatoreController@eventiOrganizzatore')
    ->name('eventiOrganizzatore');

/* Rotta per la modifica dell'evento selezionato dall'organizzatore */
Route::get('/modificaEvento/{cod_evento}', 'OrganizzatoreController@editEvent')
    ->name('editEvento');

/* Rotta per la modifica dell'evento selezionato dall'organizzatore */
Route::post('/eventiOrganizzatore', 'OrganizzatoreController@ApplyMod')
    ->name('ApplicaModifiche');

/* Rotta per la modifica delle credenziali dell'utente */
Route::post('/update', 'OrganizzatoreController@editProfileOrg')
    ->name('ModificaProfilo');

/* Rotta per la cancellazione dell'evento selezionato */
Route::get('/eventiOrganizzatore/{cod_evento}', 'OrganizzatoreController@deleteEvent')
    ->name('deleteEvent');

/* Rotta per la creazione di un evento */
Route::get('/creaEvento', 'OrganizzatoreController@createEvent')
->name('creaEvento');

Route::post('/filtra', 'OrganizzatoreController@filtra')
->name('filtra');

/* Rotta per il salvataggio del nuovo evento nel db */
Route::post('/create', 'OrganizzatoreController@saveNewEvent')
->name('salvaEvento');





/******* UTENTE LIVELLO 4 *******/

/* Modifica Organizzatore */
Route::post('/editOrganizzatore', 'AdminController@editOrganizzatore')
->name('editOrganizzatore');

/* Form: Admin Page */
Route::view('/adminPage', 'admin/adminPage')
->name('adminPage');

/* Mostra tutti gli utenti */
Route::get('/gestioneUtenti', 'AdminController@getUserList')->name('userList');

/* Mostra tutti gli organizzatori */
Route::get('/gestioneOrganizzatori', 'AdminController@getOrgList')->name('orgList');

/* Cancella user livello 2 */
Route::get('deleteUser/{nome_utente}', 'AdminController@deleteUser')->name('deleteUser');

/* Crea user livello 3 */
Route::post('/newOrg','AdminController@newOrg')->name('newOrg');

Route::get('/newOrg', 'AdminController@getOrgList')->name('newOrg');

/* Aggiungi FAQ */
Route::post('/newfaq', 'AdminController@newFAQ')->name('newFAQ');

/* Modifica FAQ */
Route::post('/editFAQ', 'AdminController@editFAQ')->name('editFAQ');

/* Cancella FAQ */
Route::get('/deleteFAQ/{cod_domanda}', 'AdminController@deleteFAQ')->name('deleteFAQ');






/******* INFO WEBSITE EZ TICKET *******/

/* Form: Dove trovarci */
Route::view('/where', 'helpers/where')
        ->name('where');

/* Form: Chi siamo */
Route::view('/who', 'helpers/who')
        ->name('who');

/* Form: FAQ */
Route::get('/Faq', 'PublicController@showFaq')
    ->name('Faq');
