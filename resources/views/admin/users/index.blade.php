@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-users')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-0">@lang('global.allUsers')</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">@lang('global.name')</th>
                                <th scope="col">@lang('global.email')</th>
                                <th scope="col">@lang('reservations.activeId')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id  }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->activeReservations as $res)
                                            <a href="{{ route('admin.reservations.show', $res) }}">{{ $res->id }}</a>
                                        @endforeach
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
