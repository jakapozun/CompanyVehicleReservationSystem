<?php

use Carbon\Carbon;

?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-1 d-flex justify-content-between align-items-baseline pl-1">
            <h1>@lang('global.availableVehicles')</h1>
            @can('view-reservations')
                <div class="mx-3">
                    <a href="{{ route('my_reservations', Auth::user()) }}">
                        <button class="btn btn-info">@lang('reservations.myRes')</button>
                    </a>
                    <a href="{{ route('calendar.index', Auth::user()) }}">
                        <button class="btn btn-info">@lang('global.calendarRes')</button>
                    </a>
                </div>
            @endcan
        </div>
        <div class="card mb-2 py-2 px-1 shadow-sm card-filters">
            {{--            <h3>@lang('global.chooseDates'):</h3>--}}
            <form action="" method="get" id="search" autocomplete="off">
                <div class="from-group">
                    @can('create-reservations','view-vehicles')
                        <pick-a-date
                            initial-start-date="{{$pickup_date}}"
                            initial-end-date="{{$dropoff_date}}"
                            reset-text="@lang('global.reset')"
                            from-text="@lang('reservations.pickupDate')"
                            to-text="@lang('reservations.dropoffDate')"
                            search-text="@lang('global.search')"
                            locale="{{app()->getLocale()}}"
                        ></pick-a-date>
                    @endcan
                </div>
            </form>
            @if(Session::has('msg'))
                <div class="alert alert-danger w-25">
                    {{Session::get('msg')}}
                </div>
            @endif
        </div>

        @can('view-vehicles')
            @foreach($vehicles as $veh)
                @if($reserved_vehicles->contains($veh->id) ? $reserved = true : $reserved = false )@endif
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div
                            class="card flex-row flex-wrap pt-2 borderW2 @if($reserved) border-danger @else border-primary @endif">
                            <div class="col-md-3 d-flex align-items-center">
                                <div class="img-thumbnail">
                                    <img class="card-img" src="{{ $veh->vehicleImage() }}" alt="slika/{{$veh->name}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <h4 class="card-title">{{$veh->name}}</h4>
                                    <p class="p-0 m-0">@lang('vehicle.brand'): {{$veh->brand}}</p>
                                    <p class="p-0 m-0">@lang('vehicle.model'): {{$veh->model}}</p>
                                    <p class="p-0 m-0">@lang('vehicle.regNumber'): {{$veh->registration_number}}</p>
                                    <div class="mt-2">
                                        @if(session()->has(['from_date','to_date']))
                                            @if(!$reserved)
                                                @can('create-reservations','view-vehicles')
                                                    <a href="{{ route('reservation.make', $veh) }}">
                                                        <button type="submit"
                                                                class="btn btn-sm btn-success">@lang('global.reserve')</button>
                                                    </a>
                                                @endcan
                                            @else
                                                <button class="btn btn-sm btn-danger"
                                                        disabled>@lang('global.reserved')</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if($reserved)
                                <div class="d-flex p-2">
                                    <div class="row" style="margin-left: 0;">
                                        @foreach($veh->reservations as $vehReservation)
                                            @if($vehReservation->dropoff_date >= Carbon::now()->format('Y-m-d H:i'))
                                                <div class="col-xs-12">
                                                    <ul class="list-group ml-auto mr-1">
                                                        <li class="list-group-item active">
                                                            <small>@lang('global.reservedFor')
                                                                : {{ $vehReservation->user->name }}</small></li>
                                                        <li class="list-group-item">
                                                            <small><strong>@lang('global.from')
                                                                    : </strong>{{ $vehReservation->pickup_date }}
                                                            </small><br>
                                                            <small><strong>@lang('global.to')
                                                                    : </strong>{{ $vehReservation->dropoff_date }}
                                                            </small>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-danger">Please login.</div>
        @endcan

        {{ $vehicles->links("pagination::bootstrap-4") }}

        @can('view-vehicles')… @endcan

    </div>
@endsection
