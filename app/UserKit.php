<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserKit extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'serial_number',
        'name',
        'status',
        'last_activity',
        'created_at',
        'udpated_at'
    ];

    public $appends = [
        'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function getIsActiveAttribute()
    {
        return Carbon::parse($this->last_activity)->diffInSeconds(Carbon::now()) < 5;
    }
}
