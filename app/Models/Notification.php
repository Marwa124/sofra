<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'action', 'notifiable_id', 'notifiable_type');
    protected $appends = ['time_spent'];

    public function getTimeSpentAttribute()
    {
      $currentTime = Carbon::now();
      $spent_time = $currentTime->diffInMinutes($this->created_at);
      return  Carbon::parse($spent_time)->format('D i');
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

}
