<?php

namespace App\Http\Controllers;

use App\Data\RandomColor;
use App\Http\Resources\CalendarResource;
use App\Models\Event;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CalendarController extends Controller
{
    public function index(User $user)
    {
        if (auth()->user()->hasRole('super-admin')) {
            $reservations = Reservation::with(['vehicle', 'user'])->get();
        }
        else if($user->exists && $user->id === auth()->id()){
            $reservations = $user->reservations()->with(['vehicle', 'user'])->get();
        }
        else{
            return abort(403);
        }

        $calendarEvents = [];

        foreach ($reservations as $reservation) {
            $calendarEvents[] = [
                "title" => $reservation->id . ": " . $reservation->user->name . ", " . $reservation->vehicle->fullname,
                "start" => $reservation->pickup_date,
                "end" => $reservation->dropoff_date,
                "backgroundColor" => RandomColor::one(['hue' => ['white', 'green'], 'luminosity' => 'dark']),
            ];
        }

        $locale = App::getLocale();
        return view('calendar', compact('calendarEvents','locale'));
    }
}
