@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-vehicles')
            <div class="row">
                <div class="col-12">
                    <div class="card p-2">
                        <div class="card-body">
                            <div class="row border-bottom">
                                <h1>@lang('vehicle.vehicle'): {{$vehicle->name}}</h1>
                            </div>

                            <div class="row">
                                <div class="col-md-5 col-cs-3 mt-2">
                                    <div class="border-dark">
                                        <img class="img-fluid" width="500px" src="{{ $vehicle->vehicleImage() }}"
                                             alt="">
                                    </div>
                                </div>

                                <div class="col-md-7 col-xs-9">
                                    <h3>@lang('vehicle.brand'): {{ $vehicle->brand }}</h3>
                                    <h4>@lang('vehicle.model'): {{ $vehicle->model }}</h4>
                                    <p>@lang('vehicle.yearModel'): {{ $vehicle->year_model }}</p>
                                    <p>@lang('vehicle.mileage'): {{ $vehicle->mileage_km }} km</p>
                                    <p>@lang('vehicle.vehicleType'): {{ $vehicle->vehicle_type }}</p>
                                    <p>@lang('vehicle.vehicleCat'): {{ $vehicle->vehicle_category }}</p>
                                    <p>@lang('vehicle.regNumber'): {{ $vehicle->registration_number }}</p>
                                    <p>@lang('vehicle.engineCap'): {{ $vehicle->engine_capacity }} (cc)</p>
                                    <p>@lang('vehicle.powerKw'): {{ $vehicle->power_kw }}</p>
                                    <p>@lang('vehicle.averageConsumption'):
                                        @empty($vehicle->average_consumption)
                                            @lang('global.noData')
                                        @endempty {{ $vehicle->average_consumption }}</p>
                                    <p>@lang('vehicle.desc'):<br>
                                        @empty($vehicle->description)
                                            @lang('global.noData')
                                        @endempty {{ $vehicle->description }}
                                    </p>
                                </div>
                            </div>

{{--                            <div class="row mt-2">--}}
{{--                                <div>--}}
{{--                                    <h4>@lang('vehicle.selectedDates'):</h4>--}}
{{--                                    @if(session()->has(['from_date', 'to_date']))--}}
{{--                                        <p>@lang('vehicle.from')--}}
{{--                                            : {{date('d-F-Y H:i',strtotime(session()->get('from_date')))}}</p>--}}
{{--                                        <p>@lang('vehicle.to')--}}
{{--                                            : {{date('d-F-Y H:i',strtotime(session()->get('to_date')))}}</p>--}}
{{--                                    @else--}}
{{--                                        <p class="alert-danger px-1">@lang('alerts.noDates')</p>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            @if(session()->has(['from_date', 'to_date']))--}}
{{--                                <div class="row">--}}
{{--                                    @if($vehicle->is_available)--}}
{{--                                        @can('create-reservations')--}}
{{--                                            <a href="{{route('reservation.make', $vehicle)}}">--}}
{{--                                                <button type="submit"--}}
{{--                                                        class="btn btn-outline-success">@lang('reservations.makeRes')</button>--}}
{{--                                            </a>--}}
{{--                                </div>--}}
{{--                                        @endcan--}}
{{--                                    @else--}}
{{--                                        <div class="alert alert-danger" role="alert">--}}
{{--                                            @lang('vehicle.VehNotAvailable')--}}
{{--                                        </div>--}}
{{--                                    @endif--}}


{{--                            <div class="row mt-2">--}}
{{--                                <a href="{{route('vehicle.index')}}">--}}
{{--                                    <button class="btn btn-outline-danger">@lang('vehicle.changeDates')</button>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            @else--}}
{{--                                <div class="row mt-2">--}}
{{--                                    <a href="{{route('vehicle.index')}}">--}}
{{--                                        <button class="btn btn-outline-danger">@lang('global.chooseDates')</button>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            @endif--}}

                        </div>

                    </div>
                </div>
            </div>
    </div>
    @endcan
    </div>
@endsection
