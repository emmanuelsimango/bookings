@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List'),'pageSlug'=>__('projector')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary row">
                        <div class="col-5">

                            <h4 class="card-title ">Reports</h4>
                            <p class="card-category"> {{$description}} </p>
                        </div>
                        <div class="col-7" style="display: flex; flex-direction:row-reverse;">
                            <div>
                                <a href="/reports" class="btn btn-sm">All</a>
                            </div>
                            <div>
                                <a href="/reports/today" class="btn btn-sm">Today</a>
                            </div>
                            <div>
                                <a href="/reports/thisWeek" class="btn btn-sm">This Week</a>
                            </div>
                            <div>
                                <a href="/reports/thisMonth" class="btn btn-sm">This Month</a>
                            </div>
                            <div>
                                <a href="/reports/thisYear" class="btn btn-sm">This Year</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Projector
                                    </th>
                                    <th>
                                        Projector department
                                    </th>
                                    <th>
                                        User name
                                    </th>
                                    <th>
                                        User department
                                    </th>
                                    <th>
                                        Approved by
                                    </th>
                                    <th>
                                        Recieved by
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                </thead>
                                <tbody>
                                    @foreach ($data as $index=>$request)

                                    <tr>
                                        <td>
                                            {{ ++$index }}
                                        </td>
                                        <td>
                                            {{ $request->projector->name }}
                                        </td>
                                        <td>
                                            {{ $request->projector->department->name }}
                                        </td>
                                        <td>
                                            {{ $request->booker->name}}
                                        </td>
                                        <td>
                                            {{ $request->booker->department->name}}
                                        </td>
                                        <td>
                                            @if($request->approved!=null)
                                                {{ $request->approved->name}}
                                            @else
                                                Pending approval
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->returnedTo!=null)
                                                {{ $request->returnedTo->name}}
                                            @else
                                                Not returned
                                            @endif
                                        </td>
                                        <td>
                                            {{ $request->created_at}}
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
    </div>
</div>
@endsection
