@component('mail::message')

    Rezervacija vozila **{{ $vehicle->name }}** za uporabnika **{{ $user->name }}**.

    Datum prevzema: **{{ $inputs['pickup_date'] }}**
    Datum vrnitve: **{{$inputs['dropoff_date']}}**.

    Podrobnosti rezervacije lahko vidite na portalu.

    Hvala.

@endcomponent
