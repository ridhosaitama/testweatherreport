@extends('dashboard.layout.main')

@section('container')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Hasil Penyimpanan Data Perkiraan Cuaca</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Perkiraan Cuaca</th>
                            <th>Suhu (&#8451;)</th>
                            <th>Terasa Seperti (&#8451;)</th>
                            <th>Kelembapan (%)</th>
                            <th>Angin (m/s)</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Waktu</th>
                            <th>Perkiraan Cuaca</th>
                            <th>Suhu (&#8451;)</th>
                            <th>Terasa Seperti (&#8451;)</th>
                            <th>Kelembapan (%)</th>
                            <th>Angin (m/s)</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ date("Y-m-d H:i:s ", $report->datetime) }}</td>
                            <td>{{ $report->weather_description }}</td>
                            <td>{{ $report->temp }}</td>
                            <td>{{ $report->feels_like }}</td>
                            <td>{{ $report->humidity }}</td>
                            <td>{{ $report->wind_speed }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
