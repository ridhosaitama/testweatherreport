@extends('dashboard.layout.main')
@section('container')
    <h1>An error occurred while fetching weather data:</h1>
    <p>{{ $error }}</p>
@endsection
