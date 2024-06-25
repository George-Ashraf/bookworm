<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_delivery extends Model
{
    use HasFactory;
    protected $table='book_delivery';



    public function book()
    {
        return $this->belongsTo(book::class, 'book_id', 'id');
    }
    public function man()
    {
        return $this->belongsTo(delivery_man::class, 'delivery_man_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(admin::class, 'admin_id', 'id');
    }
}
