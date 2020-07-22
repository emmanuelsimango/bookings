@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List'),'pageSlug'=>__('projector')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary row">
                        <div class="col-8">

                            <h4 class="card-title ">List of projectors requests</h4>
                            <p class="card-category"> </p>
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
                                        Action
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
                                            @if($request->projector->available==null)
                                                <a class="btn btn-primary btn-sm" href="/booking/approve/{{$request->id}}">Approve this</a>

                                                <a class="btn btn-danger btn-sm" href="/booking/reject/{{$request->id}}">Reject this</a>
                                            @else
                                                <strong>Not available</strong>
                                            @endif
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
