<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class days extends Model
{
    use HasFactory;
    protected $table='days';

    public function periods()
    {
        return $this->hasMany(period::class, 'day_id', 'id');
    }
}
