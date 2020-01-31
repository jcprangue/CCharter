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
    return view('main');
});


Route::get('/events/list', 'eventController@findAllEvent')->name('event-list');
Route::get('/events/all', 'eventController@list')->name('event-CRUD-all');
Route::get('/delete/event/{id}', 'eventController@delete')->name('event-delete');
Route::post('/event/save', 'eventController@save')->name('save-event');
Route::put('/event/{event}', 'eventController@update')->name('update-event');
Route::get('/import', 'CharterController@import');


Route::get('/department/list', 'departmentCOntroller@findAllDepartments')->name('department-list');
Route::post('/charter/find', 'CharterController@findDeptCharter')->name('dept-charter');
Route::get('/office/{id}', 'CharterController@findOffice')->name('office-info');
Route::get('/search/list/{id}', 'CharterController@findsearch')->name('search-info');
Route::get('/search/dept/{id}', 'CharterController@findsearchbydept')->name('search-info-dept');
Route::post('/search/service', 'CharterController@findsearchdept')->name('search-dept');


