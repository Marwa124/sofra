<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Restaurant extends Authenticatable implements JWTSubject
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'order_limit', 'delivery_fees', 'delivery_time', 'district_id', 'password', 'phone', 'whats_up', 'close_time', 'open_time', 'image', 'pin_code');
    protected $appends = ['is_open','image_url', 'rate'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getIsOpenAttribute()
    {
      $start = $this->open_time;
      $end = $this->close_time;
      $open= Carbon::now()->between($start,$end);
      if($open == true){
      return __('مفتوح');
      }
      return __('مغلق');
    }

    public function getImageUrlAttribute()
    {
      return asset($this->image);
    }

    function getRateAttribute()
    {
      $rate = $this->reviewable->avg('rate');
      return $rate;
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function installments()
    {
        return $this->hasMany('App\Models\Installment');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function classifications()
    {
        return $this->belongsToMany('App\Models\Classification');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }


      public function reviewable(){
      return $this->morphMany('App\Models\Review', 'reviewable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

}
