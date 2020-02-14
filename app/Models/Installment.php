<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{

    protected $table = 'installments';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'amount', 'date');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}
