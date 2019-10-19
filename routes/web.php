<?php
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SettingController;
use App\Note;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\DataCollector\AjaxDataCollector;

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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/');
});

Route::group(['prefix' => 'note', 'middleware' => 'auth'],function(){
    Route::get('/','NoteController@index');
    Route::post('create','NoteController@create');
    Route::post('update', 'NoteController@update');
    Route::post('delete','NoteController@delete');
    Route::post('getNote','NoteController@getNote');
    Route::post('getList','NoteController@getList');
    Route::post('imageUpload','NoteController@imageUpload');

    Route::get('trash','NoteController@trashList');
    Route::post('trash/getNote','NoteController@getTrashNote');
    Route::post('trash/getList','NoteController@getTrashList');
    Route::post('trash/restore','NoteController@restore');
    Route::post('trash/forceDelete','NoteController@forceDelete');

    Route::post('api_ajax/get_json', 'NoteController@ajax_get_json');
});

Route::group(['prefix' => 'settings' , 'middleware' => 'auth'],function(){
    Route::get('/','SettingController@index');
    Route::post('name','SettingController@settingName');
    Route::post('mail','SettingController@settingMail');
    Route::post('password','SettingController@settingPassword');
    Route::get('delete','SettingController@settingDelete');
});
