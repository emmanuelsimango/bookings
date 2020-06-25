@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Edit Profile') }}</h5>
                {{-- {{ var_dump($user??'') }} --}}
            </div>
            <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')

                    @include('alerts.success')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label>{{ __('Name') }}</label>
                        <input type="text" name="name"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Name') }}" value="{{ old('name', $user->name??'') }}">
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label>{{ __('Email address') }}</label>
                        <input type="email" name="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email address') }}" value="{{ old('email', $user->email??'') }}">
                        @include('alerts.feedback', ['field' => 'email'])
                    </div>
                    <div class="form-group{{ $errors->has('role') ? ' has-danger' : '' }}">
                        <label>{{ __('Role') }}</label>

                        <select id="role_id" class="form-control form-select" name="role_id">
                            @foreach ($roles as $item)
                            <option value="{{ $item->id }}" selected="{{ $item->id===$user->id?true:false}}">{{ $item->name }}</option>

                            @endforeach
                        </select>

                        {{-- <input type="role" name="role"
                            class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Email address') }}" value="{{ old('email', $user->email??'') }}"> --}}
                        @include('alerts.feedback', ['field' => 'role'])
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Password') }}</h5>
            </div>
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    @include('alerts.success', ['key' => 'password_status'])

                    @if(auth()->user()->id==$user->id)
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                        <label>{{ __('Current Password') }}</label>
                        <input type="password" name="old_password"
                            class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('Current Password') }}" value="" required>
                        @include('alerts.feedback', ['field' => 'old_password'])
                    </div>
                    @endif

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label>{{ __('New Password') }}</label>
                        <input type="password" name="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                            placeholder="{{ __('New Password') }}" value="" required>
                        @include('alerts.feedback', ['field' => 'password'])
                    </div>
                    <div class="form-group">
                        <label>{{ __('Confirm New Password') }}</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="{{ __('Confirm New Password') }}" value="" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
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
                            <img class="avatar" src="{{ asset('black') }}/img/emilyz.jpg" alt="">
                            <h5 class="title">{{ $user->name }}</h5>
                        </a>
                        <p class="description">
                            {{ ucfirst($user->role->name) }}
                        </p>
                    </div>
                </p>
                <div class="card-description">
                    {{-- {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    --}}
                </div>
            </div>
            <div class="card-footer">
                <div class="button-container">
                    {{-- <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
