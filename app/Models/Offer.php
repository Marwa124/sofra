<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('title', 'description', 'from', 'to', 'photo', 'restaurant_id');
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
      return asset($this->photo);
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
