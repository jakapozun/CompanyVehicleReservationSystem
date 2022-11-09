@extends('layouts.app')

@section('content')
    <div class="container">
        @can('edit-reservations')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">@lang('reservations.editReservation') <u>{{$reservation->id}}</u> </h3>

                        <form action="{{route('admin.reservations.update', $reservation)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="vehicle_id">@lang('vehicle.vehicle') ID*</label>
                                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                            <option value="{{$reservation->vehicle->id}}" selected>{{$reservation->vehicle->id}}. {{$reservation->vehicle->name}}</option>
                                            @foreach($all_veh as $veh)
                                               <option value="{{$veh->id}}">{{$veh->id}} . {{$veh->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_id">@lang('global.user') ID*</label>
                                        <select class="form-control" id="user_id" name="user_id" required>
                                            <option value="{{$reservation->user->id}}" selected>{{$reservation->user->id}}. {{$reservation->user->name}}</option>
                                            @foreach($all_users as $user)
                                                <option value="{{$user->id}}">{{$user->id}}. {{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pickup_date">@lang('reservations.pickupDate')*</label>
                                        <input type="datetime-local" name="pickup_date" class="form-control" id="pickup_date"
                                               value="{{ date('Y-m-d\TH:i', strtotime($reservation->pickup_date)) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="dropoff_date">@lang('reservations.dropoffDate')*</label>
                                        <input type="datetime-local" name="dropoff_date" class="form-control" id="dropoff_date"
                                               value="{{ date('Y-m-d\TH:i', strtotime($reservation->dropoff_date)) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination">@lang('reservations.destination')</label>
                                        <input type="text" name="destination" class="form-control" id="destination"
                                               value="{{ $reservation->destination }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_km">@lang('reservations.destination_km') (km)</label>
                                        <input type="number" name="destination_km" class="form-control"
                                               id="destination_km" value="{{ $reservation->destination_km }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="pickup_location">@lang('reservations.pickupLocation')</label>
                                        <input type="text" name="pickup_location" class="form-control"
                                               id="pickup_location" value="{{ $reservation->pickup_location }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="dropoff_location">@lang('reservations.dropoffLocation')</label>
                                        <input type="text" name="dropoff_location" class="form-control"
                                               id="dropoff_location" value="{{ $reservation->dropoff_location }}">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md 12">
                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">@lang('global.update')</button>
                                        <button type="reset" class="btn btn-danger">@lang('global.reset')</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection
