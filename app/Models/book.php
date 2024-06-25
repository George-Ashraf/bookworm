<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;
    protected $table = 'book';

    public function cate()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

    public function authorr()
    {
        return $this->belongsTo(author::class, 'author_id', 'id')->withDefault();
    }
    public function admin()
    {
        return $this->belongsTo(admin::class, 'admin_id', 'id')->withDefault();
    }
    public function bookstore()
    {
        return $this->belongsTo(bookstore::class, 'bookstore_id', 'id')->withDefault();
    }

}
