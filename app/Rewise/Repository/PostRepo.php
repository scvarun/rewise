<?php

namespace App\Rewise\Repository;

use App\Rewise\AbstractRepository;
use App\Post;

class PostRepo extends AbstractRepository {
  public function __construct() {
    $this->model = Post::class; 
  }
  public function add() {
    $post = new $this->model;
		$date = new Datetime($req->publish_date);
		$post = $this->addEditPost($post, $req, Auth::user(), $date);
		$post->save();
  }
}
