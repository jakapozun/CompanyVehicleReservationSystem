<?php

namespace App\Http\Controllers;

use App\Mail\ReservationMail;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::orderBy('created_at', 'DESC')->get();

        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $users = User::all();
        $vehicles = Vehicle::all();

        return view('admin.reservations.create', compact('users', 'vehicles'));
    }

    public function store(Request $request)
    {
        $request->validate(['terms' => 'required|accepted']);

        $destination_from = 'Selo 22, 3320 Velenje';
        $license = new StandardLicense('AIzaSyAn4S-pSxkRdgC4wTYx6xoevWmv6m9lQ80');

        $user = auth()->user();
//       $email = $user->email;

        $inputs = $request->validate([
            'vehicle_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'pickup_date' => 'required|date',
            'dropoff_date' => 'required|date',
            'destination' => 'required|string',
        ]);

        $destination_to = $inputs['destination'];
        $response = DistanceMatrix::license($license)
            ->addOrigin($destination_from)
            ->addDestination($destination_to)
            ->request();

        //distance in meters
        $distance = $response->json['rows'][0]['elements'][0]['distance']['value'];
        //path durations in minutes
//        $duration = $response->json['rows'][0]['elements'][0]['duration']['text'];

        $pickup_date = $inputs['pickup_date'];
        $dropoff_date = $inputs['dropoff_date'];
        $vehicle = Vehicle::whereId($inputs['vehicle_id'])->first();

        $existingReservations = Reservation::select()
            ->whereBetween('pickup_date', [$pickup_date, $dropoff_date])
            ->orWhereBetween('dropoff_date', [$pickup_date, $dropoff_date])
            ->get();

        foreach ($existingReservations as $existingReservation) {
            if ($existingReservation->vehicle_id == $vehicle->id) {
                Session::flash('msg', Lang::get('alerts.exists'));
                return redirect()->route('vehicle.index');
            }
        }

        $inputs['destination_km'] = ($distance / 1000);
        Reservation::create($inputs);

//                Mail::to($email)->send(new ReservationMail($vehicle, $user, $inputs));

        if($request->userRes){
            Session::flash('message_make', Lang::get('alerts.makeRes'));
            return redirect()->route('my_reservations', compact('user'));
        }

        Session::flash('message_create', Lang::get('alerts.createRes'));
        return redirect()->route('admin.reservations.index');

    }

    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $all_veh = Vehicle::all();
        $all_users = User::all();

        return view('admin.reservations.edit', compact('reservation', 'all_veh', 'all_users'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $inputs = $request->validate([
            'vehicle_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'pickup_date' => 'required',
            'dropoff_date' => 'required',
            'destination' => 'nullable|string',
            'destination_km' => 'nullable|numeric',
            'pickup_location' => 'nullable|string',
            'dropoff_location' => 'nullable|string',
        ]);

        $reservation->update($inputs);
        $reservation->save();

        Session::flash('message_update', Lang::get('alerts.updatedRes'));

        return redirect()->route('admin.reservations.index');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);

        $reservation->delete();

        Session::flash('message_delete', Lang::get('alerts.deletedRes'));

        return back();
    }

    public function make(Vehicle $vehicle)
    {
        if (\session()->has(['from_date', 'to_date'])) {
            $pickup_date = session()->get('from_date');
            $dropoff_date = \session()->get('to_date');

            $existingReservations = Reservation::select()
                ->whereBetween('pickup_date', [$pickup_date, $dropoff_date])
                ->orWhereBetween('dropoff_date', [$pickup_date, $dropoff_date])
                ->get();

            foreach ($existingReservations as $existingReservation) {
                if ($existingReservation->vehicle_id == $vehicle->id) {
                    Session::flash('msg', Lang::get('alerts.exists'));
                    return redirect()->route('vehicle.index');
                }
            }
            return view('admin.reservations.make', compact('vehicle', 'pickup_date', 'dropoff_date'));
        } else {
            Session::flash('msg', Lang::get('alerts.wrongDates'));
            return redirect()->route('vehicle.index');
        }
    }


}
