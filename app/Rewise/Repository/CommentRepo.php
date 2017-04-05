<?php

namespace App\Rewise\Repository;

use App\Rewise\AbstractRepository;
use App\Post;
use Illuminate\Http\Request;

class CommentRepo extends AbstractRepository {
  public function __construct() {
    $this->model = Comment::class; 
  }
  public function add(Post $post, Request $req) {
		$comment = new Comment();
		$comment->post_id = $post->id;
		$comment->title = $req->title;
		$comment->description = $req->description;
		$comment->rating = $req->rating;
		$comment->save();
  }

  public function edit(Comment $comment, Request $req){
		$comment->title = $req->title;
		$comment->description = $req->description;
		$comment->rating = $req->rating;
		$comment->save();
  }

  public function delete(Post $post, Comment $comment, User $user) {
    if( $post->user_id == $user->id ) {
		  $comment->delete();
      return true;
		}
    else 
      throw new Exception('You are not authorized to delete this comment.');
  }
}

