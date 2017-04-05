<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use App\Rewise\Repository\CommentRepo;

class CommentsController extends Controller
{
  private $commentRepo;

  public function __construct() {
    $this->commentRepo = new CommentRepo();
  }

	public function addCommentPage( Post $post ) {
		return view('comments.add')->with('post',$post);
	}

	public function addComment( Post $post, Request $req) {
		$this->validate($req, [
        'title' => 'required|max:255|min:3',
        'description' => 'required'
    ]);
    $this->commentRepo->add($post, $req);
		$req->session()->flash(	'alert-success', 'Comment added successfully!');
		return redirect("posts/$post->id");
	}

	public function editComment( Post $post, Comment $comment, Request $req) {
		$this->validate($req, [
				'title' => 'required|max:255|min:3',
				'description' => 'required'
		]);
    $this->commentRepo->edit($comment, $req);
		$req->session()->flash(	'alert-success', 'Comment Updated successfully!');
		return redirect("posts/$post->id");
	}

	public function editCommentPage( Post $post, Comment $comment ) {
		return view('comments.edit')->with(['post'=>$post, 'comment' => $comment]);
	}

	public function deleteComment(Post $post, Comment $comment, Request $req) {
    try {
      $this->commentRepo->delete($post,$comment,Auth::user());
      $req->session()->flash(	'alert-success', 'Comment deleted successfully!');
      return back();
    }
    catch(Exception $e) {
      return view('errors.403', [ 'message' => $e->getMessage() ]);
    }
	}
}
