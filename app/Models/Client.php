<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Authenticatable implements JWTSubject
// class Client extends Authenticatable
{

  // use HasApiTokens;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'accommodation', 'password', 'profile_image', 'pin_code');
    protected $appends = ['image_url'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getImageUrlAttribute()
    {
      return asset($this->profile_image);
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notifiable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
