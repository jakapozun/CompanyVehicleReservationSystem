<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    public function make(Reservation $reservation)
    {
        if(auth()->id() != $reservation->user->id){
            Session::flash('msg', Lang::get('alerts.wrongPath'));
            return redirect()->route('vehicle.index');
        }
        return view('admin.notes.make', compact('reservation'));
    }

    public function store(Request $request, Reservation $reservation)
    {
        $lights = $request->validate([
            'gas_light' => 'nullable',
            'service_light' => 'nullable',
            'exhaust_light' => 'nullable',
            'engine_light' => 'nullable',
        ]);

        $all_lights = implode(', ', $lights);

        $inputs = $request->validate([
            'fuel_left' => 'required',
            'refueled' => 'required',
            'comment' => 'nullable',
        ]);

        $inputs['reservation_id'] = $reservation->id;
        $inputs['lights'] = $all_lights;

        Note::create($inputs);

        Session::flash('msg_note', Lang::get('alerts.makeNote'));

        return redirect()->route('my_reservations', auth()->id());

    }

    public function update(Request $request, Note $note)
    {
        $lights = $request->validate([
            'gas_light' => 'nullable',
            'service_light' => 'nullable',
            'exhaust_light' => 'nullable',
            'engine_light' => 'nullable',
        ]);

        $all_lights = implode(', ', $lights);

        $inputs = $request->validate([
            'fuel_left' => 'nullable|required',
            'refueled' => 'nullable|required',
            'comment' => 'nullable',
        ]);

        $inputs['reservation_id'] = $note->reservation->id;
        $inputs['lights'] = $all_lights;

        $note->update($inputs);

        Session::flash('message_update', Lang::get('alerts.updateNote'));

        return redirect()->route('admin.notes.index');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->back();
    }

    public function index()
    {
        $notes = Note::all();

        return view('admin.notes.index', compact('notes'));
    }

    public function show(Note $note)
    {
        return view('admin.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('admin.notes.edit', compact('note'));
    }
}
