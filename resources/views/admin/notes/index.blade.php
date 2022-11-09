@extends('layouts.app')

@section('content')
    <div class="container">
        @can('view-reservations','edit-reservations','create-reservations','delete-reservations')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-baseline">
                            <h3 class="card-title m-b-0">@lang('global.allNotes')<span style="font-size: 0.5em"> (@lang('global.clickOnId'))</span></h3>
                        </div>

                        @if(Session::has('message_update'))
                            <div class="alert alert-success mx-1">{{ Session::get('message_update') }}</div>
                        @elseif(Session::has('message_delete'))
                            <div class="alert alert-danger mx-1">{{ Session::get('message_delete') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">@lang('reservations.reservation')</th>
                                    <th scope="col">@lang('global.user')</th>
                                    <th scope="col">@lang('global.created_at')</th>
                                    <th scope="col">@lang('global.edit')</th>
                                    <th scope="col">@lang('global.delete')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notes as $note)
                                    <tr>
                                        <td><a href="{{ route('admin.note.show', $note) }}">
                                                <button class="btn btn-outline-dark btn-sm">{{ $note->id  }}</button></a></td>
                                        <td>{{ $note->reservation_id }}</td>
                                        <td>{{ $note->reservation->user->name }}</td>
                                        <td>{{ $note->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{route('admin.note.edit', $note)}}"><button class="btn btn-primary btn-sm">@lang('global.edit')</button></a>
                                        </td>
                                        <td>
                                            <form action="{{route('admin.note.destroy', $note)}}" method="post">
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
