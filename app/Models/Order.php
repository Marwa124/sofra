<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('notes', 'payment_method_id', 'price', 'app_fees', 'restaurant_id', 'client_id', 'total', 'net','status');

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal')->withPivot('price', 'quantity', 'note');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }
  }
