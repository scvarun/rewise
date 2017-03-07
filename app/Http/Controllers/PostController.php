<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use Auth;
use App\Utils;
use Datetime;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function getPost(Post $post) {
		return view('posts.single',compact('post'));
	}

	public function addEditPost(Post $post, Request $req, User $user, Datetime $date) {
		$cats = "";
		for( $i = 0; $i <  sizeof($req->category); $i++ ) {
			$category = Category::where( 'slug', Utils::underscore($req->category[$i]) )->first();
			if ( sizeof( $category ) == 0 ) {
				$category = new Category;
				$category->title = $req->category[$i];
				$category->slug = Utils::underscore($req->category[$i]);
				$category->save();
			}
			else if ( sizeof ( $category ) != 0 && $category->title != $req->category[$i] ) {
				$category = new Category;
				$category->title = $req->category[$i];
				$no = sizeof( Category::where('slug', 'like', Utils::underscore($req->category) . '%' ) );
				$category->slug = Utils::underscore($req->category[$i]) . '_' . $no;
				$category->save();
			}
			$cats = $cats . $category->slug;
			if ( $i == sizeof( $req->category ) - 1 ) $cats = $cats . '';
			else $cats = $cats . ',';
		}
		$post->title = $req->title;
		$post->category = $cats;
		$post->user_id = $user->id;
		$post->publish_date = $date;
		$post->description = $req->description;
		return $post;
	}

	public function addPost(Request $req) {
		$this->validate($req, [
        'title' => 'required|max:255|min:3',
				'category' => 'required',
        'description' => 'required',
				'publish_date' => 'date|required'
    ]);

		$post = new Post;
		$date = new Datetime($req->publish_date);
		$post = $this->addEditPost($post, $req, Auth::user(), $date);
		$post->save();
		$req->session()->flash(	'alert-success', 'Post was successful added!');
		return back();
	}

	public function index() {
		$posts = Auth::user()->posts->all();
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
