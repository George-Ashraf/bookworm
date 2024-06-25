<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class period extends Model
{
    use HasFactory;
    protected $table='day_with_period';


    public function speaker()
    {
        return $this->belongsTo(speaker::class, 'speaker_id', 'id');
    }
}
