@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-reservations','delete-reservations','edit-reservations')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row border-bottom mb-2 ml-2">
                            <h1>@lang('reservations.reservation') <u>{{ $reservation->id }}</u></h1>
                        </div>

                        <div class="card mx-2 px-2">
                            <p><strong>@lang('vehicle.vehicle'):</strong> {{ $reservation->vehicle->name }}</p>
                            <p><strong>@lang('global.user'):</strong> {{ $reservation->user->name }}</p>
                            <p><strong>@lang('reservations.pickupDate'):</strong> {{$reservation->pickup_date}}</p>
                            <p><strong>@lang('reservations.dropoffDate'):</strong> {{ $reservation->dropoff_date }}</p>
                            <p><strong>@lang('reservations.destination'):</strong> {{ $reservation->destination }}</p>
                            <p><strong>@lang('reservations.destination_km'):</strong> {{$reservation->destination_km}}</p>
                            <p><strong>@lang('reservations.pickupLocation'):</strong> {{$reservation->pickup_location}}</p>
                            <p><strong>@lang('reservations.dropoffLocation'):</strong> {{$reservation->dropoff_location}}</p>
                            <p><strong>@lang('global.created_at'):</strong> {{$reservation->created_at->diffForHumans()}}</p>
                            <p></p>
                        </div>
                        <div class="mx-2 d-flex justify-content-between align-items-baseline">
                            <div class="pt-2">
                                <a href="{{route('admin.reservations.index')}}">
                                    <button class="btn btn-outline-danger">@lang('reservations.backToRes')</button></a>
                            </div>

                            <div class="d-flex">
                                <a href="{{route('admin.reservations.edit', $reservation)}}"><button class="btn btn-outline-primary">@lang('global.edit')</button></a>

                                <form action="{{route('admin.reservations.destroy', $reservation)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger ml-2">@lang('global.delete')</button>
                                </form>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>

@endsection
