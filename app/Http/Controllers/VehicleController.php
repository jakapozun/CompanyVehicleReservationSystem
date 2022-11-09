<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class VehicleController extends Controller
{

    public function create()
    {
        return view('admin.vehicles.create');
    }


    public function store(Request $request)
    {

        $inputs = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year_model' => 'required|numeric',
            'mileage_km' => 'required|numeric',
            'vehicle_type' => 'required|string',
            'vehicle_category' => 'required|string',
            'registration_number' => 'required|string|unique:App\Models\Vehicle',
            'body_mass' => 'numeric|nullable',
            'engine_capacity' => 'required|numeric',
            'power_kw' => 'required|numeric',
            'average_consumption' => 'nullable|numeric',
            'description' => 'nullable|string',
            'is_available' => 'required',
            'vehicle_image' => 'image|nullable',
        ]);

        if ($request->vehicle_image) {
            $inputs['vehicle_image'] = $request->vehicle_image->store('uploads', 'public');
        }

        Vehicle::create($inputs);

        Session::flash('message_create', Lang::get('alerts.createVeh'));

        return redirect()->route('admin.vehicles.index');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $inputs = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year_model' => 'required|numeric',
            'mileage_km' => 'required|numeric',
            'vehicle_type' => 'required|string',
            'vehicle_category' => 'required|string',
            'registration_number' => 'required|string',
            'body_mass' => 'numeric|nullable',
            'engine_capacity' => 'required|numeric',
            'power_kw' => 'required|numeric',
            'average_consumption' => 'nullable|numeric',
            'description' => 'nullable|string',
            'is_available' => 'required',
            'vehicle_image' => 'image|nullable',
        ]);

        if ($request->vehicle_image) {
            $inputs['vehicle_image'] = $request->vehicle_image->store('uploads', 'public');
        }

        Session::flash('message_update', Lang::get('alerts.updatedVeh'));

        $vehicle->update($inputs);
        $vehicle->save();

        return redirect()->route('admin.vehicles.index');
    }


    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        Session::flash('message_delete', Lang::get('alerts.deletedVeh'));

        return back();
    }

    public function index(Request $request)
    {
        $pickup_date = null;
        $dropoff_date = null;
        $date_now = Carbon::now()->format('Y-m-d H:i');
        $reserved_vehicles = collect();

        $validated = $this->validate($request, [
            'pickup_date' => 'nullable|date',
            'dropoff_date' => 'nullable|date',
        ]);


        //If request not empty, do this
        if (!empty($validated['pickup_date']) && !empty($validated['dropoff_date'])) {
            $pickup_date = $validated['pickup_date'];
            $dropoff_date = $validated['dropoff_date'];

            if ($pickup_date < $date_now or $dropoff_date < $date_now or $pickup_date > $dropoff_date) {
                Session::flash('msg', Lang::get('alerts.wrongDates'));
                return back();
            }
            else {
                $existingReservations = Reservation::select()
                    ->whereBetween('pickup_date', [$pickup_date, $dropoff_date])
                    ->orWhereBetween('dropoff_date', [$pickup_date, $dropoff_date])
                    ->get();

                foreach ($existingReservations as $reservation) {
                    $reserved_vehicles->push($reservation->vehicle_id);
                }

                \session(['from_date' => $pickup_date, 'to_date' => $dropoff_date]);

//                $free_vehicles = Vehicle::whereNotIn('id', $reserved_vehicles->unique()->values())->available()->get();
                $vehicles = Vehicle::orderBy('created_at', 'DESC')->available()->paginate(5);

            }

        } else {
            \session()->forget(['from_date', 'to_date']);
            $vehicles = Vehicle::orderBy('created_at', 'DESC')->available()->paginate(5);
        }

        return view('index', compact('vehicles','reserved_vehicles', 'pickup_date', 'dropoff_date'));
    }

    public function show(Vehicle $vehicle)
    {
        if (\session()->has(['from_date', 'to_date'])) {

            $pickup_date = \session()->get('from_date');
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
            return view('admin.vehicles.show', compact('vehicle'));
        }
        else {
            return view('admin.vehicles.show', compact('vehicle'));
        }
    }

    public function admin_index()
    {
        $vehicles = Vehicle::orderBy('created_at', 'DESC')->get();

        return view('admin.vehicles.index', compact('vehicles'));
    }


}
