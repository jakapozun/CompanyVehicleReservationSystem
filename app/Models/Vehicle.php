<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function vehicleImage()
    {
        if($this->vehicle_image){
            return '/storage/' . $this->vehicle_image;
        }
        else{
            $this->vehicle_image = 'uploads/default_na.png';
            return '/storage/' . $this->vehicle_image;
        }
    }

    public function getFullNameAttribute(){
        return $this->brand . " - " . $this->model;
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available',true);
    }

    public function scopeUnavailable($query)
    {
        return $query->where('is_available',false);
    }

}
