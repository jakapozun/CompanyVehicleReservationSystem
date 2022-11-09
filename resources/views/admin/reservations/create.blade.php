@extends('layouts.app')

@section('content')
    <div class="container">
        @can('create-reservations')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">@lang('reservations.createNewReservation')</h3>

                        <form action="{{route('admin.reservations.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="vehicle_id">@lang('vehicle.vehicleName')*</label>
                                        <select class="form-control" id="vehicle_id" name="vehicle_id" required>
                                            @foreach($vehicles as $veh)
                                                <option value="{{$veh->id}}">{{$veh->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_id">@lang('global.user')*</label>
                                        <select class="form-control" id="user_id" name="user_id" required>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pickup_date">@lang('reservations.pickupDate')*</label>
                                        <input type="datetime-local" name="pickup_date" class="form-control" id="pickup_date" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="dropoff_date">@lang('reservations.dropoffDate')*</label>
                                        <input type="datetime-local" name="dropoff_date" class="form-control" id="dropoff_date" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="destination">@lang('reservations.destination')</label>
                                        <input type="text" name="destination" class="form-control" id="destination">
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_km">@lang('reservations.destination_km') (km)</label>
                                        <input type="number" name="destination_km" class="form-control" id="destination_km">
                                    </div>

                                    <div class="form-group">
                                        <label for="pickup_location">@lang('reservations.pickupLocation')</label>
                                        <input type="text" name="pickup_location" class="form-control" id="pickup_location">
                                    </div>

                                    <div class="form-group">
                                        <label for="dropoff_location">@lang('reservations.dropoffLocation')</label>
                                        <input type="text" name="dropoff_location" class="form-control" id="dropoff_location">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md 12">
                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">@lang('global.create')</button>
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
