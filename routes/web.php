<?php

use App\Http\Controllers\ExampleController;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', [
    'as' => 'home',
    'uses'=> 'AuthenticationController@show',
    'middleware' => 'admin-guest'
]);

$router->post('/', 'AuthenticationController@login');

$router->get('/stagiaire',[
    'as' => 'stagiaire',
    'uses' => 'StagiaireController@lister',
    'middleware' => 'admin-auth'
]);


$router->get('/stagiaire/{stagiaireId}',[
    'as' => 'stagiaire.show',
    'uses' => 'StagiaireController@showDetails',
    'middleware' => 'admin-auth'
]);

$router->get('/demande', [
    'as' => 'demande.postuler',
    'uses' => 'DemandeController@postuler'
]);

$router->post('/demande', [
    'as' => 'demande.sauvegarder',
    'uses' => 'DemandeController@sauvegarder'
]);
$router->post('/accepter', [
    'as' => 'demande.accepter',
    'uses' => 'DemandeController@accepter'
]);

$router->get('/accepter', [
    'as' => 'stagiaires.acceptees',
    'uses' => 'DemandeController@stagiairesAcceptees',
    'middleware' => 'admin-auth'
]); 
$router->post('/refuser', [
    'as' => 'demande.refuser',
    'uses' => 'DemandeController@refuser'
]);

$router->get('/refuser', [
    'as' => 'stagiaires.refuses',
    'uses' => 'DemandeController@stagiairesRefuses',
    'middleware' => 'admin-auth'
]); 
$router->get('/deconnecter', [
    'as' => 'stagiaires.deconnecter',
    'uses' => 'DemandeController@deconnexion',
    'middleware' => 'admin-auth'
]); 