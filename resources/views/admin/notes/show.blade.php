@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-reservations','delete-reservations','edit-reservations')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row border-bottom mb-2 ml-2">
                                <h1>@lang('notes.note')<u>{{ $note->id }}</u></h1>
                            </div>

                            <div class="card mx-2 px-2">
                                <p><strong>@lang('global.user'):</strong> {{ $note->reservation->user->name }}</p>
                                <p><strong>@lang('vehicle.vehicle'):</strong> {{ $note->reservation->vehicle->name }}</p>
                                <p><strong>@lang('reservations.reservation') @lang('global.from'):</strong> {{ $note->reservation->pickup_date }}</p>
                                <p><strong>@lang('reservations.reservation') @lang('global.to'):</strong> {{ $note->reservation->dropoff_date }}</p>
                                <p><strong>@lang('notes.lights'):</strong> {{ $note->lights }}</p>
                                <p><strong>@lang('notes.fuelStatus'):</strong> {{ $note->fuel_left }}</p>
                                <p><strong>@lang('notes.refueled'):</strong> @if($note->refueled) @lang('global.yes') @else @lang('global.no') @endif</p>
                                <p><strong>@lang('notes.comment'):</strong> @if($note->comment) {{ $note->comment }} @else @lang('global.noComm') @endif</p>
                                <p><strong>@lang('global.created_at'):</strong> {{$note->created_at->diffForHumans()}}</p>
                                <p></p>
                            </div>
                            <div class="mx-2 d-flex justify-content-between align-items-baseline">
                                <div class="pt-2">
                                    <a href="{{route('admin.notes.index')}}">
                                        <button class="btn btn-outline-danger">@lang('notes.backNotes')</button></a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

@endsection
