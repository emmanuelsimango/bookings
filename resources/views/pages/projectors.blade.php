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

                    <div class="col-4 text-right">
                        <a href="{{ route('projector.create') }}" class="btn btn-sm btn-primary">Add Projector</a>
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
                    Name
                  </th>
                  <th>
                   Serial
                  </th>
                  <th>
                    Department
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
</div>
@endsection
