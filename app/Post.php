<?php

namespace App;

use Datetime;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	public function user() {
		return $this->belongsTo(User::class);
	}

	public function comments() {
		return $this->hasMany(Comment::class);
	}

	public function canWriteCommentToday() {
		$schedules = Schedule::where('user_id', $this->user_id)->get();
		$inSchedule = false;
		$date = null;
		$post_date = date("Y-m-d", strtotime($this->publish_date));
		foreach( $schedules as $schedule) {
			 $date = date("Y-m-d", strtotime( '-' . $schedule->quantity . ' ' . $schedule->duration ));
			 if( $date == $post_date ) {
				 $inSchedule = true;
				 break;
			 }
		}
		if( !$inSchedule || sizeof(Comment::where('post_id',$this->id)->whereRaw('Date(created_at)','CURDATE()')->get() ) ) {
			return false;
		}
		return true;
	}

	public function getCategories() {
		return explode( ',', $this->category );
	}
}
