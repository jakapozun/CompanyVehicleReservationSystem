<?php

use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('vehicle.index');
});

Auth::routes();

//fullcalendar
Route::get('calendar/{user?}', [App\Http\Controllers\CalendarController::class, 'index'])->name('calendar.index');

Route::middleware('auth')->group(function(){

    Route::get('locale/{locale}', function ($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    });

    Route::middleware(['role:user|admin|editor|super-admin'])->group(function(){

        Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicle.index')->middleware('permission:view-vehicles');
        Route::post('/admin/reservation/store', [App\Http\Controllers\ReservationController::class, 'store'])->name('admin.reservations.store')->middleware('permission:create-reservations');
        Route::get('/user/{user}/reservations', [App\Http\Controllers\UserController::class, 'my_reservations'])->name('my_reservations')->middleware('permission:view-reservations');
        Route::get('/vehicle/{vehicle}/reserve', [App\Http\Controllers\ReservationController::class, 'make'])->name('reservation.make')->middleware('permission:create-reservations');
        Route::delete('/admin/reservation/{reservation}/destroy', [App\Http\Controllers\ReservationController::class, 'destroy'])->name('admin.reservations.destroy')->middleware('permission:delete-reservations');

        Route::get('/notes/{reservation}', [App\Http\Controllers\NoteController::class, 'make'])->name('notes.make')->middleware('permission:create-reservations');
        Route::post('/notes/{reservation}/store', [App\Http\Controllers\NoteController::class, 'store'])->name('notes.store')->middleware('permission:create-reservations');

    });

    Route::middleware(['role:admin|super-admin'])->group(function(){

        Route::get('/admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index')->middleware('permission:view-users');
        Route::get('/admin/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('admin.roles.index')->middleware('permission:view-roles');
    });

    Route::middleware('role:editor|admin|super-admin')->group(function(){

        Route::get('/admin/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('admin.reservations.index')->middleware('permission:view-reservations');
        Route::get('/admin/reservations/create', [App\Http\Controllers\ReservationController::class, 'create'])->name('admin.reservations.create')->middleware('permission:create-reservations');
        Route::get('/admin/reservation/{reservation}/show', [App\Http\Controllers\ReservationController::class, 'show'])->name('admin.reservations.show')->middleware('permission:view-reservations');
        Route::get('/admin/reservation/{reservation}/edit', [App\Http\Controllers\ReservationController::class, 'edit'])->name('admin.reservations.edit')->middleware('permission:edit-reservations');
        Route::patch('/admin/reservation/{reservation}/update', [App\Http\Controllers\ReservationController::class, 'update'])->name('admin.reservations.update')->middleware('permission:edit-reservations');

        Route::get('/admin/vehicles', [App\Http\Controllers\VehicleController::class, 'admin_index'])->name('admin.vehicles.index')->middleware('permission:view-vehicles');
        Route::get('/admin/vehicle/create', [App\Http\Controllers\VehicleController::class, 'create'])->name('admin.vehicles.create')->middleware('permission:create-vehicles');
        Route::post('/admin/vehicle/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('admin.vehicles.store')->middleware('permission:create-vehicles');
        Route::get('/admin/vehicle/{vehicle}/edit', [App\Http\Controllers\VehicleController::class, 'edit'])->name('admin.vehicles.edit')->middleware('permission:edit-vehicles');
        Route::patch('/admin/vehicle/{vehicle}/update', [App\Http\Controllers\VehicleController::class, 'update'])->name('admin.vehicles.update')->middleware('permission:edit-vehicles');
        Route::delete('/admin/vehicle/{vehicle}/destroy', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('admin.vehicles.destroy')->middleware('permission:delete-vehicles');
        Route::get('/vehicle/{vehicle}/show', [App\Http\Controllers\VehicleController::class, 'show'])->name('vehicle.show')->middleware('permission:view-vehicles');


        Route::get('/admin/notes', [App\Http\Controllers\NoteController::class, 'index'])->name('admin.notes.index')->middleware('permission:edit-reservations');
        Route::get('/admin/note/{note}/show', [App\Http\Controllers\NoteController::class, 'show'])->name('admin.note.show')->middleware('permission:edit-reservations');
        Route::get('/admin/note/{note}/edit', [App\Http\Controllers\NoteController::class, 'edit'])->name('admin.note.edit')->middleware('permission:edit-reservations');
        Route::patch('/admin/note/{note}/update', [App\Http\Controllers\NoteController::class, 'update'])->name('admin.note.update')->middleware('permission:edit-reservations');
        Route::delete('/admin/note/{note}/delete', [App\Http\Controllers\NoteController::class, 'destroy'])->name('admin.note.destroy')->middleware('permission:edit-reservations');

    });

});


