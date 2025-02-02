<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_payment_book extends Model
{
    use HasFactory;
    protected $table='user_payment_book';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
