<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassificationRestaurant extends Model 
{

    protected $table = 'classification_restaurants';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'classification_id');

}