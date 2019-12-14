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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('patient/register', 'Api\MyAuth\PatientAuthController@register');
Route::post('patient/login', 'Api\MyAuth\PatientAuthController@login');

Route::group(['prefix' => 'patient'], function () {
    Route::post('medical-services/list', 'Api\MedicalServices\Controller\MedicalServicesController@list');
    Route::post('appointments/list', 'Api\Appointments\Controller\AppointmentsController@list');
});

Route::group(['prefix' => 'agent'], function () {
    Route::post('medical-services/list', 'Api\MedicalServices\Controller\MedicalServicesController@list');
    Route::post('medical-services/create', 'Api\MedicalServices\Controller\MedicalServicesController@create');
    Route::post('medical-services/{id}/update', 'Api\MedicalServices\Controller\MedicalServicesController@update');
    Route::post('invoices/create', 'Api\Invoices\Controller\InvoicesController@create');
    Route::post('appointments/list', 'Api\Appointments\Controller\AppointmentsController@list');
});
