@extends('layouts.app')

@section('content')
    <div class="container">
        @can('create-reservations')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>@lang('notes.reservationNote') <u>{{$note->reservation->id}}</u></h2>

                            <div class="row mb-2">
                                <div class="col-md 12">
                                    <ul class="list-group">
                                        <li class="list-group-item active">@lang('vehicle.vehicle'): {{ $note->reservation->vehicle->name }}</li>
                                        <li class="list-group-item">@lang('global.user'): {{ $note->reservation->user->name . ' | ' . $note->reservation->user->email }}</li>
                                        <li class="list-group-item">@lang('global.from'): {{ $note->reservation->pickup_date }}</li>
                                        <li class="list-group-item">@lang('global.to'): {{ $note->reservation->dropoff_date }}</li>
                                        <li class="list-group-item">@lang('reservations.destination'): {{ $note->reservation->destination }}</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.note.update', $note) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="lights">Prižgala se je lučka za:</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Lučka za gorivo"
                                                               id="light_fuel" name="gas_light">
                                                        <label class="form-check-label" for="light_fuel">
                                                            Lučka za gorivo
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Lučka za servis"
                                                               id="light_service" name="service_light">
                                                        <label class="form-check-label" for="light_service">
                                                            Lučka za servis
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Lučka za izpušne pline"
                                                               id="light_exhaust" name="exhaust_light">
                                                        <label class="form-check-label" for="light_exhaust">
                                                            Lučka za izpušne pline
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="Lučka za motor"
                                                               id="light_engine" name="engine_light">
                                                        <label class="form-check-label" for="light_engine">
                                                            Lučka za motor
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="gas">Koliko goriva je ostalo?</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="fuel_left"
                                                               id="fuel_left" value="full" checked>
                                                        <label class="form-check-label" for="fuel_left">
                                                            Polno
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="fuel_left"
                                                               id="fuel_left" value="half">
                                                        <label class="form-check-label" for="fuel_left">
                                                            Pri polovici
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="fuel_left"
                                                               id="fuel_left" value="empty">
                                                        <label class="form-check-label" for="fuel_left">
                                                            Skoraj prazno
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="gas">Ali ste tankali?</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="refueled"
                                                               id="added_fuel" value="{{true}}" checked>
                                                        <label class="form-check-label" for="added_fuel">
                                                            Da
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="refueled"
                                                               id="added_fuel" value="{{false}}">
                                                        <label class="form-check-label" for="added_fuel">
                                                            Ne
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="extra_comment">Dodaj poljuben komentar:</label>
                                            <textarea class="form-control" id="extra_comment"
                                                      rows="3" name="comment">{{$note->comment}}</textarea>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-success" type="submit">@lang('global.update')</button>
                                            <a href="{{ route('admin.notes.index') }}"><button type="button" class="btn btn-outline-danger">@lang('global.cancel')</button></a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
@endsection
