@extends('layouts.app')

@section('content')
    <div class="container">
        @can('create-reservations')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">@lang('reservations.makeRes')</h3>
                        <form action="{{route('admin.reservations.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="userRes" value="{{true}}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_id">@lang('vehicle.vehicleName')*</label>
                                        <input type="text" class="form-control" id="vehicle_id" value="{{$vehicle->name}}" disabled>
                                        <input type="hidden" name="vehicle_id" value="{{$vehicle->id}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="user_id">@lang('global.user')*</label>
                                        <input type="text" class="form-control" id="user_id" value="{{auth()->user()->name}}" disabled>
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="destination_from">@lang('reservations.pickupLocation'):</label>
                                        <input type="text" class="form-control" id="destination_from" value="Velenje" disabled>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="pickup_date">@lang('reservations.pickupDate')*</label>
                                        <input type="text" class="form-control" id="pickup_date" value="{{$pickup_date}}" disabled>
                                        <input type="hidden" name="pickup_date" value="{{$pickup_date}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="dropoff_date">@lang('reservations.dropoffDate')*</label>
                                        <input type="text" class="form-control" id="dropoff_date" value="{{$dropoff_date}}" disabled>
                                        <input type="hidden" name="dropoff_date" value="{{$dropoff_date}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="to_places">@lang('reservations.destination')*<small>( Ljubljana, Munich, Prešernova cesta 10... )</small>:</label>
                                        <places></places>
                                    </div>

                                    <div class="form-group">
                                        <label for="">@lang('reservations.extraKm'):</label>
                                        <input type="number" name="" class="form-control" id="">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md 12">
                                    <h3>@lang('reservations.terms')</h3>
                                    <p>@lang('reservations.termsAgreed')</p>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                                        <label class="form-check-label" for="terms">
                                            @lang('reservations.termsCheckbox')*
                                        </label>
                                    </div>
                                    @if(Session::has('msg_terms'))
                                        {{ Session::get('msg_terms') }}
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md 12">
                                    <div class="form-group d-flex justify-content-between">
                                        <button type="submit" class="btn btn-success">@lang('global.reserve')</button>
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
