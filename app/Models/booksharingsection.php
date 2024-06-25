<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booksharingsection extends Model
{
    use HasFactory;

    protected $table = 'book_sharing_section';
    protected $fillable = ['section_name'];



    /**
     * Get all of the comments for the booksharingsection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booksharingone()
    {
        return $this->hasMany(booksharing_one::class, 'BS_section_id', 'id');
    }
    public function booksharingtwo()
    {
        return $this->hasMany(booksharing_two::class, 'BS_section_id', 'id');
    }
    public function user1()
    {
        return $this->belongsTo(User::class, 'share_one', 'id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'share_two', 'id');
    }


}
