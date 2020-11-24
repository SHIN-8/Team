<?php

use Illuminate\Support\Facades\Route;

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
// TEAM
Route::get('team/admin', 'TeamController@admin')->name('team.admin');
Route::get('team/user', 'TeamController@user')->name('team.user');
Route::get('team/place', 'TeamController@place')->name('team.place');
Route::get('team/result', 'TeamController@result')->name('team.result');
Route::get('team/schedule', 'TeamController@schedule')->name('team.schedule');
Route::resource('team', 'TeamController',['only'=>['index','show','edit','update',]]);
// SCHEDULE
Route::resource('schedules', 'SchedulesController');
Route::resource('userschedules', 'UserschedulesController',['only'=>['store']]);
Route::resource('userresults', 'UserresultsController',['only'=>['store','destroy']]);
Route::resource('pitchresults', 'PitchresultsController',['only'=>['store','destroy']]);
// RESULT
Route::resource('results', 'ResultsController');
Route::get('results/build/{result}', 'ResultsController@build');
Route::get('results/buildEdit/{result}', 'ResultsController@buildEdit');
Route::get('results/pitchBuild/{result}', 'ResultsController@pitchBuild');
Route::get('results/pitchBuildEdit/{result}', 'ResultsController@pitchBuildEdit');
// TABLE
Route::get('table', 'TablesController@index')->name('table.index');
Route::get('table/games', 'TablesController@games')->name('table.games');
Route::get('table/r', 'TablesController@r')->name('table.r');
Route::get('table/hits', 'TablesController@hits')->name('table.hits');
Route::get('table/two', 'TablesController@two')->name('table.two');
Route::get('table/three', 'TablesController@three')->name('table.three');
Route::get('table/homerun', 'TablesController@homerun')->name('table.homerun');
Route::get('table/atbat', 'TablesController@atbat')->name('table.atbat');
Route::get('table/bat', 'TablesController@bat')->name('table.bat');
Route::get('table/steal', 'TablesController@steal')->name('table.steal');
Route::get('table/fourball', 'TablesController@fourball')->name('table.fourball');
Route::get('table/k', 'TablesController@k')->name('table.k');
Route::get('table/bant', 'TablesController@bant')->name('table.bant');
Route::get('table/sacrificefly', 'TablesController@sacrificefly')->name('table.sacrificefly');
Route::get('table/onbase', 'TablesController@onbase')->name('table.onbase');
Route::get('table/slugging', 'TablesController@slugging')->name('table.slugging');
Route::get('table/ops', 'TablesController@ops')->name('table.ops');
Route::get('table/pitchgames', 'TablesController@pitchgames')->name('table.pitchgames');
Route::get('table/pitchwin', 'TablesController@pitchwin')->name('table.pitchwin');
Route::get('table/pitchlose', 'TablesController@pitchlose')->name('table.pitchlose');
Route::get('table/pitchsave', 'TablesController@pitchsave')->name('table.pitchsave');
Route::get('table/pitchera', 'TablesController@pitchera')->name('table.pitchera');
Route::get('table/pitchinning', 'TablesController@pitchinning')->name('table.pitchinning');
Route::get('table/pitchearned_run', 'TablesController@pitchearned_run')->name('table.pitchearned_run');
Route::get('table/pitchruns_allowed', 'TablesController@pitchruns_allowed')->name('table.pitchruns_allowed');
Route::get('table/pitchk', 'TablesController@pitchk')->name('table.pitchk');
Route::get('table/pitchfourball', 'TablesController@pitchfourball')->name('table.pitchfourball');
// USER
Route::resource('users', 'UsersController');
Route::get('users/total/{user}', 'UsersController@total')->name('users.total');
// ALBUM
Route::resource('album', 'AlbumController',['only'=>['index','show','store','destroy',]]);
// BLOG
Route::resource('blog', 'BlogController');
// PLACE
Route::resource('place', 'PlaceController');
// CONTACT
Route::get('contact', 'ContactController@index')->name('contact.index');
Route::post('contact/confirm', 'ContactController@confirm')->name('contact.confirm');
Route::post('contact/complete', 'ContactController@complete')->name('contact.complete');
// AUTH
Auth::routes();
// HOME
Route::get('/', 'HomeController@index')->name('home');
// VOYAGER
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
