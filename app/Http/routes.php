<?php

/***************************************
 *
 *              FRONT
 *
 ***************************************/
Route::get('language', ['as' => 'language', 'uses' => 'Front\RootController@language']);

Route::get('register', ['as' => 'register', 'uses' => 'Front\RootController@register']);
Route::post('postRegister', ['as' => 'postRegister', 'uses' => 'Front\RootController@store']);

Route::post('authentification', array('as' => 'authentification', 'uses' => 'Front\RootController@login'));
Route::get('logout', ['as' => 'root.logout', 'uses' => 'Front\RootController@logout']);

// Password Reset Link Request Routes...
Route::get('password/email', array('as' => 'password/email', 'uses' => 'Front\RootController@getEmail'));
Route::post('password/email', array('as' => 'password/email', 'uses' => 'Front\RootController@postEmail'));

// Password Reset Routes...
Route::get('password/reset', array('as' => 'password/reset', 'uses' => 'Front\RootController@getReset'));
Route::post('password/reset', array('as' => 'password/reset', 'uses' => 'Front\RootController@postReset'));

// Home Routes
Route::get('/', ['as' => 'home', 'uses' => 'Front\HomePageController@index']);

//Rubriques Route
Route::get('rubrique/{id}', ['as' => 'rubrique/index', 'uses' => 'Front\RubriqueController@index']);

//Reponse Route
Route::get('reponse/{id}', ['as' => 'reponse/index', 'uses' => 'Front\ReponseController@index']);
Route::post('reponse/store', ['as' => 'reponse/store', 'uses' => 'Front\ReponseController@store']);
Route::post('reponse/{id}', ['as' => 'reponse.delete', 'uses' => 'Front\ReponseController@destroy']);
Route::post('reponse/updateSujet/{sujet}', ['as' => 'reponse.updateSujet', 'uses' => 'Front\ReponseController@updateSujet']);


//Creation Sujet Route
Route::get('question/index', ['as' => 'question/index', 'uses' => 'Front\QuestionController@index']);
Route::post('question/store', ['as' => 'question/store', 'uses' => 'Front\QuestionController@store']);


// Gestion Compte Route
Route::get('compte/index', ['as' => 'compte/index', 'uses' => 'Front\CompteController@index']);
Route::put('compte/update/{users}', ['as' => 'compte/update', 'uses' => 'Front\CompteController@update']);




/***************************************
 *
 *              BACK
 *
 ***************************************/
Route::get('/administration', ['as' => 'bo', 'uses' => 'Admin\AdminPageController@index']);


//Route::post('search', ['as' => 'actu.search', 'uses' => 'Admin\ActuController@search']);


Route::resource('gestionLanguage', 'Admin\GestionLanguageController');
Route::put('majfiles/{id}', ['as' => 'gestionLanguage.majfiles', 'uses' => 'Admin\GestionLanguageController@majfiles']);


Route::resource('notifications', 'Admin\NotificationController');
Route::post('delete_notifications', ['as' => 'notifications.deleteAll', 'uses' => 'Admin\NotificationController@deleteAll']);


Route::resource('newsletters', 'Admin\NewslettersController');
Route::post('newsletterssearch', ['as' => 'newsletters.search', 'uses' => 'Admin\NewslettersController@search']);


Route::resource('mails', 'Admin\MailsController');
Route::post('mailssearch', ['as' => 'mails.search', 'uses' => 'Admin\MailsController@search']);
Route::post('mails/{mails}', ['as' => 'mails.actif', 'uses' => 'Admin\MailsController@actif']);


Route::resource('mailsHistorique', 'Admin\MailsHistoriqueController');
Route::post('delete_historiqueMails', ['as' => 'mailsHistorique.deleteAll', 'uses' => 'Admin\MailsHistoriqueController@deleteAll']);


Route::get('envoieMails', ['as' => 'envoieMails.index', 'uses' => 'Admin\EnvoieMailsController@index']);
Route::post('envoieMailsSend/{users}', ['as' => 'envoieMails.send', 'uses' => 'Admin\EnvoieMailsController@send']);
Route::post('envoieMailsAll', ['as' => 'envoieMails.all', 'uses' => 'Admin\EnvoieMailsController@all']);
Route::post('envoieMailsPers', ['as' => 'envoieMails.pers', 'uses' => 'Admin\EnvoieMailsController@pers']);


Route::resource('users', 'Admin\UsersController');
Route::post('userssearch', ['as' => 'users.search', 'uses' => 'Admin\UsersController@search']);
Route::post('users/{users}', ['as' => 'users.actif', 'uses' => 'Admin\UsersController@actif']);
Route::put('gestion_password/{users}', ['as' => 'utilisateur.gestion_password', 'uses' => 'Admin\UsersController@gestion_password']);


Route::resource('langues', 'Admin\LanguesController');
Route::post('languessearch', ['as' => 'langues.search', 'uses' => 'Admin\LanguesController@search']);


Route::resource('crons', 'Admin\CronsController');

// Clears cache
Route::get('clearsCache', ['as' => 'clearsCache.reset', 'uses' => 'Admin\ClearsCacheController@reset']);

// Rubrique
Route::resource('rubrique', 'Admin\RubriqueController');
Route::post('rubriquesearch', ['as' => 'rubrique.search', 'uses' => 'Admin\RubriqueController@search']);
Route::post('rubrique/{rubrique}', ['as' => 'rubrique.actif', 'uses' => 'Admin\RubriqueController@actif']);


// Sujet du forum
Route::resource('sujet', 'Admin\SujetController');
Route::post('sujetsearch', ['as' => 'sujet.search', 'uses' => 'Admin\SujetController@search']);
Route::post('sujet/{sujet}', ['as' => 'sujet.actif', 'uses' => 'Admin\SujetController@actif']);

// Réponse des sujets
Route::resource('reponse', 'Admin\ReponseController');


//AUTHENTICATION
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
