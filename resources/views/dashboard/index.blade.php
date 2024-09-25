@extends('dashboard.layout.main')
@section('container')

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Weather Report</h1>
                        <h3 class="h4 mb-0 text-gray-800">Lokasi: {{ $weatherData['name'] }}</h3>
                            <h3 class="h4 mb-0 text-gray-800">Update:
                                {{date("Y-m-d H:i:s ", $weatherData['dt']) }}
                            </h3>
                            <a href="#" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#savedata">
                                <span class="icon">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </a>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="row">
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif



                    <!-- Content Row -->
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
                        <div class="col-xl-3 col-md-6 mb-4">

                        </div>
                    </div>


                    <!-- Logout Modal-->
                <div class="modal fade" id="savedata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Simpan data?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Simpan data" dibawah ini jika ingin menyimpan data saat ini</div>
                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-success" href="/savedata">Simpan</a>
                        </div>
                    </div>
                </div>
                </div>
@endsection
