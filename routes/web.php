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

Route::get('/', function () {
    return Redirect('/publication');
});

Auth::routes();

Route::group(['middleware' => ['auth']],function (){
    Route::resources([
        'publication' => 'PublicationController',
    ]);
    Route::get('/myPublications', 'PublicationController@my')->name('publication.my');

    Route::group(['prefix' => 'publication','as' => 'publication'],function () {
        Route::post('/like', 'PublicationEventController@like')->name('like');
        Route::post('/dislike', 'PublicationEventController@dislike')->name('dislike');
        Route::post('/comment', 'PublicationEventController@comment')->name('comment');
    });
});

