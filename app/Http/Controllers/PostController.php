<?php

namespace App\Http\Controllers;

use App\Rewise\Repository\PostRepo;

use App\Post;
use App\Category;
use App\User;
use Auth;
use App\Utils;
use Datetime;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
  private $postRepo;

  public function __construct() {
    $this->postRepo = new PostRepo();
  }

	public function getPost(Post $post) {
    try {
      $post = $this->postRepo->get($post, Auth::user());
      return view('posts.single',compact('post'));
    }
    catch(Exception $e) {
      return view('errors.403', [ 'message' => $e->getMessage() ]);
    }
	}

	public function addPost(Request $req) {
		$this->validate($req, [
        'title' => 'required|max:255|min:3',
				'category' => 'required',
        'description' => 'required',
				'publish_date' => 'date|required'
    ]);
    $this->postRepo->add($req,Auth::user());
		$req->session()->flash(	'alert-success', 'Post was successful added!');
		return back();
	}

	public function index() {
    $posts = $this->postRepo->indexByUser(Auth::user());
		return view('posts.index',compact('posts'));
	}

	public function addPostPage() {
		$categories = Category::all();
		return view('posts.add', compact('categories'));
	}

	public function getEditPostPage(Post $post) {
		$categories = Category::all();
		return view('posts.edit')->with([
			'categories' => $categories,
			'post' => $post
		]);
	}

	public function saveEditPostPage(Post $post, Request $req) {
    $this->postRepo->edit($post, $req);
		$req->session()->flash(	'alert-success', 'Post updated successfully!');
		return back();
	}

	public function deletePost($id, Request $req) {
    try {
      $title = $this->postRepo->delete($id,$req, Auth::user());
			$req->session()->flash(	'alert-success', '"' . $title .  '" deleted successfully!');
			return redirect('/posts');
    }
    catch(Exception $e) {
      $req->session()->flash(	'alert-success', $e->getMessage());
      return back();
    }
	}
}
