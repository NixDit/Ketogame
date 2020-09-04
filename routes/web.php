<?php

use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::get('/', 'HomeController@show')->name('home.show'); //Ruta del index
Route::get('/tournament', 'TournamentController@index')->name('tournament.show');
Route::get('/tournaments-all', 'TournamentController@showTournaments')->name('tournament.show-all');
Route::post('/tournaments-sign-me', 'TournamentController@signMeUp')->name('tournament.sign-me')->middleware('auth');
// Route::post('/tournaments-send-images', 'TournamentController@sendImages')->name('tournament.send-images')->middleware('auth');
Route::post('/tournaments-send-image', 'TournamentController@sendImage')->name('tournament.send-image')->middleware('auth');
Route::get('/send-user-to-login', 'TournamentController@sendToLogin')->name('tournament.send-to-login')->middleware('auth');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::post('/send-message', 'MessagesController@sendMessage')->name('message.send');
Route::view('/privacy-notice', 'help.privacy-notice')->name('help.privacy');

// ONLY ADMIN ROUTES
Route::group(['middleware' => ['role:superadmin','auth']], function () {
    // Tournaments
    Route::post('statusTournament', 'admin\TournamentController@changeStatus')->name('tournaments.status');
    Route::post('InactiveLog', 'FunctionsController@InactiveLog')->name('InactiveLog');
    Route::post('InactiveAllLog', 'FunctionsController@InactiveAllLog')->name('InactiveAllLog');
    Route::post('champion-tournament', 'admin\TournamentController@setChampion')->name('setChampion');
    // Administrators
    Route::resource('administradores', 'admin\AdministratorsController')->names('administrators')->parameters(['administrators' => 'id'])->except(['update']);
    Route::post('administradores/{id}', 'admin\AdministratorsController@update')->name('administradores.update');
});

// ADMIN && MODERATOR ROUTES
Route::group(['middleware' => ['role:superadmin|moderator','auth']], function () {
    // Tournaments
    Route::resource('torneos', 'admin\TournamentController')->names('tournaments')->parameters(['tournaments' => 'id'])->except(['update']);
    Route::post('torneos/{id}', 'admin\TournamentController@update')->name('torneos.update');
    Route::get('players-tournament/{id}', 'admin\TournamentController@showUserByTournament')->name('showUserByTournament');
    Route::get('excel-tournament/{id}/{complete?}/{incomplete?}', 'admin\TournamentController@excel_tournament')->name('excel_tournament');
    // Admin
    Route::resource('admin', 'admin\AdminController')->names('admin')->parameters(['admin' => 'id']);
    // Users
    Route::resource('jugadores', 'admin\AdminUsersController')->names('usersAdmin')->parameters(['usersAdmin' => 'id'])->except(['update']);
    Route::post('jugadores/{id}', 'admin\AdminUsersController@update')->name('jugadores.update');
    Route::get('tournaments-user/{id}', 'admin\AdminUsersController@showTournamentsByUser')->name('showTournamentsByUser');
    Route::post('deleteUserParticipation', 'admin\AdminUsersController@deleteUserParticipation')->name('deleteUserParticipation');
    // Global routes
    Route::get('getEspecificUsers/{type}','admin\AdminUsersController@getEspecificUsers')->name('getEspecificUsers');
    Route::post('setDarkMode', 'FunctionsController@setDarkMode')->name('setDarkMode');
});

// ALL USERS ROUTES
Route::group(['middleware' => ['role:superadmin|moderator|guest','auth']], function () {
    Route::post('/users/update', 'UsersController@update')->name('users.update');
    Route::post('/users/profile-picture', 'UsersController@profileImage')->name('users.image');
    Route::post('/updatestats', 'UsersController@updatefortnite')->name('users.stats');
    Route::get('/myprofile', 'UsersController@show')->name('users.show');
});

//Rutas Auth
Auth::routes();
