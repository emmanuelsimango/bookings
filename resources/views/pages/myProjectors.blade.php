@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List'),'pageSlug'=>__('myProjectors')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary row">
                        <div class="col-8">

                            <h4 class="card-title ">My Projectors history</h4>
                            <p class="card-category"> Here is a list of all projectors i have booked</p>
                        </div>
                        @if(Auth::user()->role_id==1)
                            <div class="col-4 text-right">
                                <a href="{{ route('projector.create') }}" class="btn btn-sm btn-primary">Add Projector</a>
                            </div>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Serial
                                    </th>
                                    <th>
                                        Department
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Date
                                    </th>

                                </thead>
                                <tbody>
                                    @foreach (Auth::user()->projectors as $index=>$booking)

                                    <tr>
                                        <td>
                                            {{ ++$index }}
                                        </td>
                                        <td>
                                            {{ $booking->projector->name }}
                                        </td>
                                        <td>
                                            {{ $booking->projector->serial }}
                                        </td>
                                        <td>
                                            {{ $booking->projector->department->name??'' }}
                                        </td>
                                        <td>
                                            @if($booking->returned_to > 0)
                                                Returned
                                            @else
                                                @if($booking->approved_by>0)
                                                    Still with me
                                                @else
                                                    pending
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {{$booking->created_at}}
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
