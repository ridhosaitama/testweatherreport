@extends('dashboard.layout.main')
@section('container')

{{-- <button id="get-location">Get Location</button>
<p id="location-result"></p> --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cek Cuaca Berdasarkan Lokasi</h1>

    <button class="btn btn-primary btn-icon-split" id="get-location">
        <span class="icon">
            <i class="fa-solid fa-floppy-disk"></i>
        </span>
        <span class="text">Dapatkan Lokasi</span>
    </button>

</div>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Lokasi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if(session('latitude') && session('longitude'))
                                <p>Latitude: {{ session('latitude') }}</p>
                                <p>Longitude: {{ session('longitude') }}</p>

                                <a href="/weather-on-location" class="btn btn-primary btn-icon-split">
                                    <span class="icon">
                                        <i class="fa-solid fa-floppy-disk"></i>
                                    </span>
                                    <span class="text">Dapatkan Informasi Cuaca</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi</h6>
            </div>
            <div class="card-body">
                @if ($message = Session::get('get-success'))
                <div class="row">
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h3 class="h4 mb-0 text-gray-800">Lokasi: {{ $weatherData['name'] }}</h3>
                <h3 class="h4 mb-0 text-gray-800">Update: {{date("Y-m-d H:i:s ", $weatherData['dt']) }}</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class = "row">
    <div class="col-xl-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Informasi Cuaca</h6>
            </div>
            <div class="card-body">
                @if ($message = Session::get('get-success'))
                    <div class="row">
                        <!-- Card  -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Perkiraan Cuaca
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['weather'][0]['description'] }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <img src="https://openweathermap.org/img/wn/{{ $weatherData['weather'][0]['icon'] }}.png"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Temperatur (&#8451;)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['main']['temp'] }} &#8451;
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-temperature-low fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Kelembapan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['main']['humidity']}}%
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-droplet fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Terasa Seperti</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['main']['feels_like'] }} &#8451;
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-temperature-arrow-up fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Tekanan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['main']['pressure']}}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-temperature-low fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-dark shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                                Angin</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $weatherData['wind']['speed'] }}m/s
                                                {{ $weatherData['wind']['deg'] }}&deg;
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-wind fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @if ($message = Session::get('get-error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
