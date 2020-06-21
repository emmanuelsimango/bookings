@extends('layouts.app', ['page' => __('Tables'), 'pageSlug' => 'department'])

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card ">
      <div class="card-header row">
          <div class="col-8">
              <h4 class="card-title"> Departments</h4>
              <p>Here is a list of all departments</p>
        </div>
        <div class="col-4">
            <a href="{{ route('department.create') }}" class="btn btn-primary">Add New Department</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table tablesorter " id="">
            <thead class=" text-primary">
              <tr>
                <th>
                  #
                </th>
                <th>
                  Name
                </th>
                <th class="text-center">
                  Projectors
                </th>
              </tr>
            </thead>
            <tbody>
                @foreach ($departments as $index => $dept)
                    <tr>
                    <td>
                    {{++$index }}
                    </td>
                    <td>
                        {{ $dept->name }}
                    </td>
                    <td>
                    {{ $dept->projectors()->count() }}
                    </td>
                    </tr>

                @endforeach

            </tbody>
          </table>
          {{ $departments->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
