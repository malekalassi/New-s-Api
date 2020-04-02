<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title' , 'content','written_date',
        'featured_image','voted_up','voted_down','user_id',
        'category_id'
    ];
}
