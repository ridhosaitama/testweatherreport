@extends('dashboard.layout.main')
@section('container')
<h1>Current Weather in {{ $weatherData['location']['name'] }}</h1>
<p>Description: {{ $weatherData['current']['condition']['text'] }}</p>
<p>Temperature: {{ $weatherData['current']['temp_c'] }} &#8451;</p>
@endsection
