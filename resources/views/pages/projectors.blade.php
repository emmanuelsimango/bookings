@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List'),'pageSlug'=>__('projector')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary row">
                        <div class="col-8">

                            <h4 class="card-title ">Projectors</h4>
                            <p class="card-category"> Here is a list of all projectors</p>
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
                                        Availability
                                    </th>
                                    <th>
                                        Action
                                    </th>

                                </thead>
                                <tbody>
                                    @foreach ($projectors as $index=>$projector)

                                    <tr>
                                        <td>
                                            {{ ++$index }}
                                        </td>
                                        <td>
                                            {{ $projector->name }}
                                        </td>
                                        <td>
                                            {{ $projector->serial }}
                                        </td>
                                        <td>
                                            {{ $projector->department->name??'' }}
                                        </td>
                                        <td>
                                            {{ $projector->available==null? 'Available':'Booked' }}
                                        </td>
                                        <td>
                                            @if($projector->available==null)
                                                <a href="projector/request/{{ $projector->id }}">Book the projector</a>
                                            @else
                                                <strong>Not available</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $projectors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
