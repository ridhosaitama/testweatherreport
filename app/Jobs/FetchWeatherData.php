<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use App\Models\WeatherReport;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchWeatherData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiKey = env('OPENWEATHER_API_KEY');
        //$client = new Client();
        $lat = '-6.197602';
        $lon = '106.879792';
        $apiUrlOWM = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey&lang=id&units=metric";


            // Make a GET request to the OpenWeather API
            $response = Http::get($apiUrlOWM);

            if ($response->successful()) {
                $data = $response->json();
                //$data = json_decode($response->getBody(), true);
                //dd($data);
                // $dt = date("Y-m-d\TH:i:s\Z", $data['dt']);
                WeatherReport::create([
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
            }
    }
}
