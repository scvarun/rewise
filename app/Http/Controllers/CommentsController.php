<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{

	public function addCommentPage( Post $post ) {
		return view('comments.add')->with('post',$post);
	}

	public function addComment( Post $post, Request $req) {

		$this->validate($req, [
        'title' => 'required|max:255|min:3',
        'description' => 'required'
    ]);

		$comment = new Comment();
		$comment->post_id = $post->id;
		$comment->title = $req->title;
		$comment->description = $req->description;
		$comment->rating = $req->rating;
		$comment->save();

		$req->session()->flash(	'alert-success', 'Comment added successfully!');
		return redirect("posts/$post->id");
	}

	public function editComment( Post $post, Comment $comment, Request $req) {

		$this->validate($req, [
				'title' => 'required|max:255|min:3',
				'description' => 'required'
		]);

		$comment->title = $req->title;
		$comment->description = $req->description;
		$comment->rating = $req->rating;
		$comment->save();

		$req->session()->flash(	'alert-success', 'Comment Updated successfully!');
		return redirect("posts/$post->id");

	}

	public function editCommentPage( Post $post, Comment $comment ) {
		return view('comments.edit')->with(['post'=>$post, 'comment' => $comment]);
	}

	public function deleteComment(Post $post, Comment $comment, Request $req) {
		if( $post->user_id == Auth::user()->id ) {
			$comment->delete();
		}
		$req->session()->flash(	'alert-success', 'Comment deleted successfully!');
		return back();
	}

}
