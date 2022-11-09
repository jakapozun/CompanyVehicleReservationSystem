@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="app">
            <calendar-component locale="{{$locale}}" :events='@json($calendarEvents)'></calendar-component>
        </div>
    </div>
@endsection
