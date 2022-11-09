@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-reservations','edit-reservations','create-reservations','delete-reservations')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-baseline">
                        <h3 class="card-title m-b-0">@lang('global.allRes')<span style="font-size: 0.5em"> (@lang('global.clickOnId'))</span></h3>
                        <div>
                            <a href="{{route('admin.reservations.create')}}"><button class="btn btn-info">@lang('reservations.createNewReservation')</button></a>
                        </div>
                    </div>

                    @if(Session::has('message_update'))
                        <div class="alert alert-success mx-1">{{ Session::get('message_update') }}</div>
                    @elseif(Session::has('message_create'))
                        <div class="alert alert-success mx-1">{{ Session::get('message_create') }}</div>
                    @elseif(Session::has('message_delete'))
                        <div class="alert alert-danger mx-1">{{ Session::get('message_delete') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">@lang('vehicle.vehicle')</th>
                                <th scope="col">@lang('global.user')</th>
                                <th scope="col">@lang('global.startDate')</th>
                                <th scope="col">@lang('global.endDate')</th>
                                <th scope="col">@lang('global.created_at')</th>
                                <th scope="col">@lang('global.edit')</th>
                                <th scope="col">@lang('global.delete')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $res)
                                <tr>
                                    <td><a href="{{ route('admin.reservations.show', $res) }}">
                                            <button class="btn btn-outline-dark btn-sm">{{ $res->id  }}</button></a></td>
                                    <td>{{ $res->vehicle->name }}</td>
                                    <td>{{ $res->user->name }}</td>
                                    <td>{{ $res->pickup_date }}</td>
                                    <td>{{ $res->dropoff_date }}</td>
                                    <td>{{ $res->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{route('admin.reservations.edit', $res)}}"><button class="btn btn-primary btn-sm">@lang('global.edit')</button></a>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.reservations.destroy', $res)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">@lang('global.delete')</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection
