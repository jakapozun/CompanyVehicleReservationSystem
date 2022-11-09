@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('message_make'))
            <div class="alert alert-success mx-1">{{ Session::get('message_make') }}</div>
        @elseif(Session::has('msg_note'))
            <div class="alert alert-success mx-1">{{ Session::get('msg_note') }}</div>
        @endif
        @can('view-reservations', 'create-reservations')
                    <div class="accordion" id="accordionReservations">
{{--                            Active Reservations--}}
                            <div class="row mb-2">
                                <div class="col-12">
                                    <div class="card border border-success" id="headingOne">
                                        <div type="button" class="card-body" aria-expanded="true">
                                            <h3 class="card-title m-b-0" data-toggle="collapse" data-target="#collapseActive">@lang('reservations.active')</h3>
                                            @if(($user->activeReservations->count() == null) ? $actData = true : $actData = false)
                                                <p>@lang('global.noData')</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="collapseActive" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionReservations">
                                @foreach($user->activeReservations as $res)
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="card card-my-reservation-active">
                                                <div class="card-body d-flex justify-content-between align-items-end">
                                                    <div class="col-md-5">
                                                        <p style="font-size: 20px;"><strong>@lang('reservations.reservation'):</strong> {{ $res->id }}</p>
                                                        <p><strong>@lang('global.user'): </strong>{{ $user->name }}</p>
                                                        <p><strong>@lang('vehicle.vehicle'):</strong> {{ $res->vehicle->name }}</p>
                                                        <p><strong>@lang('reservations.pickupDate'):</strong> {{ $res->pickup_date }}</p>
                                                        <p><strong>@lang('reservations.dropoffDate'):</strong> {{ $res->dropoff_date }}</p>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <p><strong>@lang('reservations.destination'):</strong> {{ $res->destination }}</p>
                                                        <p><strong>@lang('reservations.destination_km') (Km):</strong> {{ $res->destination_km }}</p>
                                                        <p><strong>@lang('reservations.totalDistance') (Km):</strong> {{ ($res->destination_km) * 2 }}</p>
                                                        <p><strong>@lang('global.created_at'):</strong> {{ $res->created_at }} <strong> -- </strong> {{ $res->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    <div class="col-md-2 text-right">
                                                        <a href="{{ route('notes.make', $res) }}"><button class="btn btn-primary mb-1">@lang('global.addNote')</button></a>
                                                        <form action="{{route('admin.reservations.destroy', $res)}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Please confirm to delete reservation.')" class="btn btn-danger">@lang('global.delete')</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

{{--                        Current Reservations--}}
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="card border border-primary" id="headingTwo">
                                    <div type="button" class="card-body">
                                        <h3 class="card-title m-b-0" data-toggle="collapse" data-target="#collapseCurrent">@lang('reservations.current')</h3>
                                        @if($user->currentReservations->count() == null)
                                            <p>@lang('global.noData')</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="collapseCurrent" class="collapse @if($actData) show @endif" aria-labelledby="headingTwo" data-parent="#accordionReservations">
                            @foreach($user->currentReservations as $res)
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card card-my-reservation-current">
                                            <div class=" card-body d-flex justify-content-between align-items-end">
                                                <div class="col-md-5">
                                                    <p style="font-size: 20px;"><strong>@lang('reservations.reservation'):</strong> {{ $res->id }}</p>
                                                    <p><strong>@lang('global.user'): </strong>{{ $user->name }}</p>
                                                    <p><strong>@lang('vehicle.vehicle'):</strong> {{ $res->vehicle->name }}</p>
                                                    <p><strong>@lang('reservations.pickupDate'):</strong> {{ $res->pickup_date }}</p>
                                                    <p><strong>@lang('reservations.dropoffDate'):</strong> {{ $res->dropoff_date }}</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <p><strong>@lang('reservations.destination'):</strong> {{ $res->destination }}</p>
                                                    <p><strong>@lang('reservations.destination_km') (Km):</strong> {{ $res->destination_km }}</p>
                                                    <p><strong>@lang('reservations.totalDistance') (Km):</strong> {{ ($res->destination_km) * 2 }}</p>
                                                    <p><strong>@lang('global.created_at'):</strong> {{ $res->created_at }} <strong> -- </strong> {{ $res->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <form action="{{route('admin.reservations.destroy', $res)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">@lang('global.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


{{--                        History Reservations--}}
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="card border border-danger" id="headingThree">
                                    <div type="button" class="card-body">
                                        <h3 class="card-title m-b-0" data-toggle="collapse" data-target="#collapseHistory">@lang('reservations.history')</h3>
                                        @if($user->historyReservations->count() == null)
                                            <p>@lang('global.noData')</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="collapseHistory" class="collapse" aria-labelledby="headingThree" data-parent="#accordionReservations">
                            @foreach($user->historyReservations as $res)
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <div class="card card-my-reservation-history">
                                            <div class=" card-body d-flex justify-content-between">
                                                <div class="col-md-6">
                                                    <p style="font-size: 20px;"><strong>@lang('reservations.reservation'):</strong> {{ $res->id }}</p>
                                                    <p><strong>@lang('global.user'): </strong>{{ $user->name }}</p>
                                                    <p><strong>@lang('vehicle.vehicle'):</strong> {{ $res->vehicle->name }}</p>
                                                    <p><strong>@lang('reservations.pickupDate'):</strong> {{ $res->pickup_date }}</p>
                                                    <p><strong>@lang('reservations.dropoffDate'):</strong> {{ $res->dropoff_date }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>@lang('reservations.destination'):</strong> {{ $res->destination }}</p>
                                                    <p><strong>@lang('reservations.destination_km') (Km):</strong> {{ $res->destination_km }}</p>
                                                    <p><strong>@lang('reservations.totalDistance') (Km):</strong> {{ ($res->destination_km) * 2 }}</p>
                                                    <p><strong>@lang('global.created_at'):</strong> {{ $res->created_at }} <strong> -- </strong> {{ $res->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            @endcan
    </div>
@endsection
