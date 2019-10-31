<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = ['title', 'content', 'user_id', 'image_url'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
