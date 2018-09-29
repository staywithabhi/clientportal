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

Route::auth();


Route::get('/', function () {
    return view('vendor.adminlte.home');
    })->middleware('auth');
Route::get('profile','UserController@profile');
Route::post('profile','UserController@update_profile');
Route::get('/members/manage/',['as'=>'manageMembers','uses'=>'MemberController@index','middleware'=>'roles','roles'=>['manager']]);
Route::get('/member/add/',['as'=>'addMember','uses'=>'MemberController@addMemberToClient','middleware'=>'roles','roles'=>['manager']]);
Route::post('member/save',['as'=>'memberSave','uses'=>'MemberController@saveMemberToClient','middleware'=>'roles','roles'=>['manager']]);
Route::get('member/delete/{id}',['as'=>'memberDelete','uses'=>'MemberController@destroy','middleware'=>'roles','roles'=>['manager']]);
Route::get('member/edit/{id}',['as'=>'memberEdit','uses'=>'MemberController@edit','middleware'=>'roles','roles'=>['manager']]);
Route::put('member/update/{id}',['as'=>'memberUpdate','uses'=>'MemberController@update','middleware'=>'roles','roles'=>['manager']]);
// Route::post('uploadImage','ClientController@imageUpload');
