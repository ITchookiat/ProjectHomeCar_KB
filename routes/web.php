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
    return redirect('/home');   // redirect เป็นการบังคับวิ่งเข้าหน้า web
});

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    //----------------Admin register-----------------//
    route::resource('MasterMaindata','UserController');

    route::resource('MasterDatacar','DatacarController');
    Route::post('/ExportPDFIndex', 'DatacarController@ReportPDFIndex');
    Route::get('/datacar/viewsee/{id}/{car_type}', 'DatacarController@viewsee')->name('datacar.viewsee');
    Route::get('/datacar/view/{type}', 'DatacarController@index')->name('datacar');
    Route::get('/datacar/create/{type}', 'DatacarController@create')->name('datacar.create');
    Route::post('/datacar/store', 'DatacarController@store')->name('datacar.store');
    Route::get('/datacar/edit/{id}/{car_type}', 'DatacarController@edit')->name('datacar.edit');
    Route::patch('/datacar/updateinfo/{id}', 'DatacarController@updateinfo')->name('datacar.updateinfo');
    Route::delete('/datacar/delete/{id}', 'DatacarController@destroy')->name('datacar.destroy');
    Route::get('/datacar/Savestore/{Str1}/{Str2}/{type}', 'DatacarController@Savestore')->name('datacar.Savestore');
    Route::post('/datacar/SearchData/{type}', 'DatacarController@SearchData')->name('datacar.SearchData');

    route::resource('reportBetween','ReportController');
    Route::get('/reportcar/viewreport/{type}', 'ReportController@index')->name('reportcar');
    Route::get('/ExportStockcar', 'ReportController@ReportExpire');
    Route::post('/Report/homecar', 'ReportController@ReportStockcar')->name('report.holdcar');
    Route::get('/Report/Home/{type}', 'ReportController@index')->name('report');

    route::resource('MasterResearchCus','ResearchCusController');
    Route::get('/ResearchCus/view/{type}', 'ResearchCusController@index')->name('ResearchCus');
    Route::post('/ResearchCus/SearchData/{type}', 'ResearchCusController@SearchData')->name('ResearchCus.SearchData');
    Route::get('/ResearchCus/ReportCus/{type}', 'ResearchCusController@ReportCustoms')->name('ResearchCus.ReportCus');

    Route::get('/BoardMaster/view/{type}', 'BoardController@index')->name('BoardMaster');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/{name}', 'HomeController@index')->name('index');
});