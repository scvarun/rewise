<?php

namespace App\Rewise\Repository;

use App\Rewise\AbstractRepository;
use App\Post;
use App\User;
use App\Category;
use Datetime;
use App\Utils;
use Illuminate\Http\Request;

class PostRepo extends AbstractRepository {
  public function __construct() {
    $this->model = Post::class; 
  }

  public function add( Request $req, User $user ) {
    $post = new $this->model;
		$date = new Datetime($req->publish_date);
		$post = $this->addEditPost($post, $req, $user, $date);
		$post->save();
  }

	public function edit(Post $post, Request $req) {
		$user = User::find($post->user_id);
		$date = new Datetime($post->publish_date);
		$post = $this->addEditPost($post, $req, $user, $date);
		$post->save();
		$req->session()->flash(	'alert-success', 'Post updated successfully!');
		return back();
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
 
}
