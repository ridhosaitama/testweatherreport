<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use App\Models\WeatherReport;
use Illuminate\Console\Command;

class FetchWeatherData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-weather-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch weather data from OpenWeather API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        $client = new Client();
        $lat = '-6.197602';
        $lon = '106.879792';
        $apiUrlOWM = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&lang=id&units=metric";

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

            $this->info('Weather data fetched and stored successfully!');

        } catch (\Exception $e) {
            $this->error('Failed to fetch data from OpenWeather API');
        }
    }
}
