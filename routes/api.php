<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['as' => 'api.'], function () {
    Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'Api\UploadController@image']);
    Route::post('upload/video', ['as' => 'upload.video', 'uses' => 'Api\UploadController@video']);
    Route::post('upload/editor', ['as' => 'upload.editor', 'uses' => 'Api\UploadController@editor']);
});
Route::get('alipay/consume/callback', ['as' => 'api.alipay.consume.callback', 'uses' => 'Api\Alipay\ConsumeController@callback']);
Route::get('alipay/consume/notify', ['as' => 'api.alipay.consume.notify', 'uses' => 'Api\Alipay\ConsumeController@notify']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
