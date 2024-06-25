<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about extends Model
{
    use HasFactory;
    protected $table='contact_us';


    public function user()
    {
        return $this->belongsTo(User::class, 'reader_id', 'id');
    }
    public function author()
    {
        return $this->belongsTo(author::class, 'author_id', 'id');
    }
    public function bookstore()
    {
        return $this->belongsTo(bookstore::class, 'bookstore_id', 'id');
    }
}
