<?php

use App\Jobs\FetchWeatherData;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\LocationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/cobasession', function () {
    return view('cobasession');
});

Route::post('/store-location', [LocationController::class, 'store']);
Route::get('/get-location', [LocationController::class, 'showLocation']);




//

Route::get('/dashboard', [WeatherController::class, 'getWeather']);
Route::get('/table', [WeatherController::class, 'getData']);

Route::get('/ceklokasi', function(){
    return view('dashboard.checklocation');
});

Route::post('/store-location', [LocationController::class, 'store']);
Route::get('/weather-on-location', [WeatherController::class, 'getWeatherOnLocation']);


Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::get('/savedata', [WeatherController::class, 'saveWeather']);



Route::get('/fetch-weather', function () {
    FetchWeatherData::dispatch();
    return 'Weather data fetching initiated!';
});
