<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weatherreport', function (Blueprint $table) {
            $table->id();                               //  primary, increment
            $table->string('weather_main');             //  API = main weather condition
            $table->string('weather_description');      //  API = weather description
            $table->string('weather_icon');             //  API = weather condition icon
            $table->double('temp');               //  API = weather temprature C
            $table->double('temp_min');           //  API = weather temprature min C
            $table->double('temp_max');           //  API = weather temprature max C
            $table->double('feels_like');         //  API = weather temprature feelslike C
            $table->smallInteger('pressure');           //  API = weather pressure
            $table->unsignedTinyInteger('humidity');    //  API = weather humidity
            $table->double('wind_speed');               //  API = weather wind speed
            $table->smallInteger('wind_degree');        //  API = weather wind degree
            $table->unsignedInteger('datetime');        //  API = date time unix
            $table->date('datesave');                   //  date save
            $table->softDeletes();                      //  softdeleting
            $table->timestamps();                       //  timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weatherreport');
    }
};
