<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'body',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
