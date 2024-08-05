<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function reports()
    {
        return $this->hasMany(ZonalReport::class);
    }

    public function coordinators()
    {
        return $this->hasMany(User::class)->where('role', 'zonal_coordinator');
    }
}
