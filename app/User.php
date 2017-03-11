<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

		public function posts() {
			return $this->hasMany(Post::class);
		}

		public function schedules() {
			return $this->hasMany(Schedule::class);
		}

    public function addSchedule($quantity, $duration) {
			$sche = new Schedule();
			$sche->user_id = $this->id;
			$sche->quantity = $quantity;
			$sche->duration = strtolower($duration);
			$sche->save();
    }
}
