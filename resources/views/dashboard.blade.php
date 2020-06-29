@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card card-chart">
            <div class="card-header ">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <h5 class="card-category">Total Bookings</h5>
                        <h2 class="card-title">
                            <i class="tim-icons icon-bell-55 text-primary"></i> {{ $bookings }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="display-4 text-center">

                </p>
                {{--  <div class="chart-area">
                        {{--  <canvas id="chartBig1"></canvas>
                    </div>  --}}
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Total Users</h5>
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i> {{ $users }}</h3>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card card-chart">
            <div class="card-header">
                <h5 class="card-category">Total Projectors</h5>
                <h3 class="card-title"><i class="tim-icons icon-delivery-fast text-info"></i> {{ $projectors }}</h3>
            </div>
            <div class="card-body">
                {{--  <div class="chart-area">
                    <canvas id="CountryChart"></canvas>
                </div>  --}}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="card card-tasks">
            <div class="card-header ">
                <h6 class="title d-inline">Booked Projectors({{ count($booked_projectors) }})</h6>
                <p class="card-category d-inline">today</p>
                <div class="dropdown">
                    <button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
                        <i class="tim-icons icon-settings-gear-63"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/booking">View All</a>
                        <a class="dropdown-item" href="/department">Departments</a>
                        <a class="dropdown-item" href="/projectors">Projectors</a>
                    </div>
                </div>
            </div>
            <div class="card-body ">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <tbody>
                        @foreach ($booked_projectors as $index=> $projector)

                            <tr>
                                <td>
                                    {{  ++$index }}
                                </td>
                                <td>
                                    <p class="title">     {{$projector->projector->name}}</p>
                                    <p class="text-muted">{{$projector->projector->department->name}}</p>
                                </td>
                                <td class="td-actions text-right">
                                    <p class="text-muted">{{$projector->booker->name}}</p>

                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Available Projectors</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table tablesorter" id="">
                        <thead class=" text-primary">
                            <tr>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Serial
                                </th>
                                <th>
                                    Department
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($available_projectors as $projector)


                                <tr>
                                    <td>
                                        {{ $projector->name }}
                                    </td>
                                    <td>
                                        {{ $projector->serial }}
                                    </td>
                                    <td>
                                        {{ $projector->department?$projector->department->name:'--' }}
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    $(document).ready(function() {
          demo.initDashboardPageCharts();
        });
</script>
@endpush
