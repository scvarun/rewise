<?php

namespace App\Http\Controllers;

use App\Rewise\Repository\PostRepo;

use App\Post;
use App\Category;
use App\User;
use Auth;
use App\Utils;
use Datetime;
use Illuminate\Http\Request;

class PostController extends Controller
{
  private $postRepo;

  public function __construct() {
    $this->postRepo = new PostRepo();
  }

	public function getPost(Post $post) {
		return view('posts.single',compact('post'));
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
    $posts = new PostRepo();
    $posts = $posts->index();
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
		$user = User::find($post->user_id);
		$date = new Datetime($post->publish_date);
		$post = $this->addEditPost($post, $req, $user, $date);
		$post->save();
		$req->session()->flash(	'alert-success', 'Post updated successfully!');
		return back();
	}

	public function deletePost($id, Request $req) {
		$post = Post::find($id);
		if( Auth::user()->id == $post->user_id ) {
			$req->session()->flash(	'alert-success', '"' . $post->title .  '" deleted successfully!');
			$post->delete();
			return redirect('/posts');
		}
		$req->session()->flash(	'alert-success', "Post couldn't be deleted");
		return back();
	}
}
