@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-vehicles','edit-vehicles','delete-vehicles','create-vehicles')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-baseline">
                        <h3 class="card-title m-b-0">@lang('global.allVeh') <span style="font-size: 0.5em"> (@lang('global.clickOnId'))</span></h3>
                        <a href="{{ route('admin.vehicles.create') }}">
                            <button class="btn btn-primary">@lang('vehicle.createNewVeh')</button>
                        </a>
                    </div>

                    @if(Session::has('message_create'))
                        <div class="alert alert-success mx-1">{{ Session::get('message_create') }}</div>
                    @elseif(Session::has('message_update'))
                        <div class="alert alert-success mx-1">{{ Session::get('message_update') }}</div>
                    @elseif(Session::has('message_delete'))
                        <div class="alert alert-danger mx-1">{{ Session::get('message_delete') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">@lang('vehicle.brand')</th>
                                <th scope="col">@lang('vehicle.model')</th>
                                <th scope="col">@lang('vehicle.category')</th>
                                <th scope="col">@lang('vehicle.regNumber')</th>
                                <th scope="col">@lang('global.created_at')</th>
                                <th scope="col">@lang('global.created_at')</th>
                                <th scope="col">@lang('global.edit')</th>
                                <th scope="col">@lang('global.delete')</th>
                            </tr>
                            </thead>
                            <tbody class="align-items-center align-content-center">
                            @foreach($vehicles as $veh)
                                <tr>
                                    <td>
                                        <form action="{{route('vehicle.show', $veh)}}" method="get">
                                            <button type="submit" class="btn btn-outline-dark btn-sm">{{$veh->id}}</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($veh->is_available)
                                            <button class="btn btn-success btn-sm" disabled>@lang('global.available')</button>
                                        @else
                                            <button class="btn btn-danger btn-sm" disabled>@lang('global.unavailable')</button>
                                        @endif
                                    </td>
                                    <td>{{ $veh->brand }}</td>
                                    <td>{{ $veh->model }}</td>
                                    <td>{{ $veh->vehicle_category }}</td>
                                    <td>{{ $veh->registration_number }}</td>
                                    <td>{{ $veh->created_at }}<br>{{ $veh->created_at->diffForHumans() }}</td>
                                    <td>{{ $veh->updated_at }}<br>{{ $veh->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{route('admin.vehicles.edit', $veh)}}"><button class="btn btn-info btn-sm">@lang('global.edit')</button></a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.vehicles.destroy', $veh) }}" method="post" enctype="multipart/form-data">
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
