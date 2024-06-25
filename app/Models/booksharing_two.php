<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booksharing_two extends Model
{
    use HasFactory;
    protected $table="book_sharing_two";



    public function section()
    {
        return $this->belongsTo(booksharingsection::class, 'BS_section_id', 'id');
    }
    public function reader()
{
    return $this->belongsTo(user::class, 'reader_id', 'id');
}
}
