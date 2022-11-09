<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

use Illuminate\Contracts\Validation;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    //Get all existing reservations
    public function getAllReservationsAttribute()
    {
        return $this->reservations()->orderBy('created_at', 'DESC')->get();
    }

    public function getHistoryReservationsAttribute()
    {
        $date_now = Carbon::now();
        $date_now->toDateTimeString();

        return $this->reservations()
            ->whereDate('dropoff_date','<', $date_now)->get();
    }

    public function getActiveReservationsAttribute()
    {
        $date_now = Carbon::now();
        $date_now->toDateTimeString();

        return $this->reservations()
            ->whereDate('pickup_date', '<=', $date_now)
            ->whereDate('dropoff_date', '>=', $date_now)
            ->get();
    }

    public function getCurrentReservationsAttribute()
    {
        $date_now = Carbon::now();
        $date_now->toDateTimeString();

        return $this->reservations()
            ->whereDate('pickup_date','>', $date_now)
            ->whereDate('dropoff_date', '>', $date_now)
            ->get();
    }



}
