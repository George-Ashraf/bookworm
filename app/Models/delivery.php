<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery extends Model
{
    use HasFactory;

    protected $table = 'delivery';

    public function booksharingsectionid()
    {
        return $this->belongsTo(booksharingsection::class, 'booksharing_section_id', 'id');
    }
    public function frombooksharingone()
    {
        return $this->belongsTo(booksharing_one::class, 'from_booksharing_one', 'id')->withDefault();
    }
    public function tobooksharingtwo()
    {
        return $this->belongsTo(booksharing_two::class, 'to_booksharing_two', 'id')->withDefault();
    }
    public function frombooksharingtwo()
    {
        return $this->belongsTo(booksharing_two::class, 'from_booksharing_two', 'id')->withDefault();
    }
    public function tobooksharingone()
    {
        return $this->belongsTo(booksharing_one::class, 'to_booksharing_one', 'id')->withDefault();
    }
    public function deliverymanid()
    {
        return $this->belongsTo(delivery_man::class, 'delivery_man_id', 'id');
    }
    public function adminid()
    {
        return $this->belongsTo(admin::class, 'admin_id', 'id');
    }
}
