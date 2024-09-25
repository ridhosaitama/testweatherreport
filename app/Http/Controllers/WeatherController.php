<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Models\WeatherReport;
use Illuminate\Support\Facades\Session;

class WeatherController extends Controller
{
    public function getWeather()
    {
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKeyOWM = env('OPENWEATHER_API_KEY');
        //$apiKeyWAPI = 'b3c10a8362f04c0e9ad75650242009';

        // Create a new Guzzle client instance
        $client = new Client();
        $lat = '-6.197602';
        $lon = '106.879792';
        // API endpoint URL with your desired location and units
        $apiUrlOWM = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKeyOWM&lang=id&units=metric";
        //$apiUrlWAPI = "http://api.weatherapi.com/v1/current.json?q=$lat, $lon&key=$apiKeyWAPI&lang=id";

        try {
            // Make a GET request to the OpenWeather API
            $response = $client->get($apiUrlOWM);
            //$response = $client->get($apiUrlWAPI);

            // get body response
            $data = json_decode($response->getBody(), true);

            // $dt = date("Y-m-d\TH:i:s\Z", $data['dt']);

            // return data
            return view('/dashboard/index', ['weatherData' => $data]);

        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return view('/dashboard/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function saveWeather(Request $request){
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKeyOWM = env('OPENWEATHER_API_KEY');

        // Create a new Guzzle client instance
        $client = new Client();
        $lat = '-6.197602';
        $lon = '106.879792';
        // API openweathermap URL
        $apiUrlOWM = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKeyOWM&lang=id&units=metric";

        try {
            // Make a GET request to the OpenWeather API
            $response = $client->get($apiUrlOWM);
            //$response = $client->get($apiUrlWAPI);

            // get body response
            $data = json_decode($response->getBody(), true);
            //dd($data);
            // $dt = date("Y-m-d\TH:i:s\Z", $data['dt']);
            $saveddata = WeatherReport::create([
                'datetime' => $data['dt'],
                'datesave' => now(),
                'weather_main' => $data['weather'][0]['main'] ,
                'weather_description'=> $data['weather'][0]['description'],
                'weather_icon' => $data['weather'][0]['icon'],
                'temp' => $data['main']['temp'],
                'temp_min'=> $data['main']['temp_min'],
                'temp_max'=> $data['main']['temp_max'],
                'feels_like'=> $data['main']['feels_like'],
                'pressure'=> $data['main']['pressure'],
                'humidity'=> $data['main']['humidity'],
                'wind_speed'=> $data['wind']['speed'],
                'wind_degree'=> $data['wind']['deg'],
            ]);
            //dd($saveddata);
            // return data
            return redirect('/dashboard')->with('success', 'Data Cuaca Berhasil Disimpan');

        } catch (\Exception $e) {
            // Handle any errors that occur during the API request
            return redirect('/dashboard')->with('error', 'Data Cuaca Gagal Disimpan');
            //return view('/dashboard/api_error', ['error' => $e->getMessage()]);
        }
    }

    public function getWeatherOnLocation(){
        // Replace 'YOUR_API_KEY' with your OpenWeather API key
        $apiKeyOWM = env('OPENWEATHER_API_KEY');

        // Create a new Guzzle client instance
        $client = new Client();
        $lat = Session::get('latitude');
        $lon = Session::get('longitude');

        // API openweathermap URL
        $urlOWM = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKeyOWM&lang=id&units=metric";

        try {
            // Make a GET request to the OpenWeather API
            $response = $client->get($urlOWM);
            //$response = $client->get($apiUrlWAPI);

            // get body response
            $data = json_decode($response->getBody(), true);
            //dd($data);

            // return data
            session()->flash('get-success', 'Berhasil Mendapatkan Data');
            return view('/dashboard/checklocation', ['weatherData' => $data]);

        } catch (\Exception $e) {
            session()->flash('get-error', 'Task was successful!');
            return view('/dashboard/api_error', ['error' => $e->getMessage()]);
        }

    }

    public function getData(){
        $reports = WeatherReport::latest()->get();
        //dd($reports);
        return view('/dashboard/table', compact('reports'));
        //dd($reports);
    }
}


