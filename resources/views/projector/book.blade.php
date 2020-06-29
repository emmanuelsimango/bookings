@extends('layouts.app', ['page' => __('Book a projector'), 'pageSlug' => 'booking'])
@section('content')
    <div class="content" id="app">
        <book :projectors="{{ $projectors->toJson() }}" :bookings="{{ $bookings }}" :staff="{{ $staff }}"></book>
    </div>
@endsection
