<?php

namespace App\Rewise\Repository;

use App\Rewise\AbstractRepository;
use App\Post;

class CommentRepo extends AbstractRepository {
  public function __construct() {
    $this->model = Comment::class; 
  }

  public function add(Array $arr) {
    $post = $arr['post'];
		$comment = new Comment();
		$comment->post_id = $post->id;
		$comment->title = $req->title;
		$comment->description = $req->description;
		$comment->rating = $req->rating;
		$comment->save();
  }
}
