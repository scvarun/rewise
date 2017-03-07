<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Datetime;

class Schedule extends Model
{
    //
		protected $table = 'schedule';

		public function getPosts() {

			$date = date("Y-m-d", strtotime( '-' . $this->quantity . ' ' . $this->duration ));

			$posts = Post::where(
				[
					'user_id'=>$this->user_id,
					'publish_date'=>$date
				]
			)->get();

			return $posts;
		}
}
