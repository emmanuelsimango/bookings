@extends('layouts.app', ['page' => __('Projector Create'), 'pageSlug' => 'projector'])
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Add Projector') }}</h5>
                </div>
                <form method="post" action="{{ !empty($projector)?route('profile.update'):route('projector.store') }}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @if(!empty($projector))
                                @method('put')
                            @endif

                            @include('alerts.success')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name')}}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Serial') }}</label>
                                <input type="text" name="serial" class="form-control{{ $errors->has('serial') ? ' is-invalid' : '' }}" placeholder="{{ __('Serial Number') }}" value="{{ old('serial') }}">
                                @include('alerts.feedback', ['field' => 'serial'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Booking Duration (hrs)') }}</label>
                                <input type="number" name="booking_duration" class="form-control{{ $errors->has('booking_duration') ? ' is-invalid' : '' }}" placeholder="{{ __('Max Booking Duration') }}" value="{{ old('booking_duration') }}">
                                @include('alerts.feedback', ['field' => 'booking_duration'])
                            </div>
                            <div class="form-group{{ $errors->has('department_id') ? ' has-danger' : '' }}">
                                <label>{{ __('Department') }}</label>
                                <select id="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}" name="department_id">
                                    @foreach ($departments as $dept)
                                        <option class="text-muted" value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>

                                {{-- <input type="number" name="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}" placeholder="{{ __('Department') }}" value="{{ old('department_id') }}"> --}}
                                @include('alerts.feedback', ['field' => 'department_id'])
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a href="#">
                                {{-- <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt=""> --}}
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>

                        </div>
                    </p>

                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
