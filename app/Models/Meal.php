<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{

    protected $table = 'meals';
    public $timestamps = true;
    protected $fillable = array('name', 'ingredients', 'image', 'price', 'price_offer', 'restaurant_id', 'classification_id');
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset($this->image);
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\Classification');
    }

    public function reviewable()
    {
        return $this->morphMany('App\Models\Review', 'reviewable');
    }

}
