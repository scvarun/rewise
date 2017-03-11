<?php

namespace App\Rewise\Repository;

use App\Rewise\AbstractRepository;
use App\Post;

class PostRepo extends AbstractRepository {
  public function __construct() {
    $this->model = Post::class; 
  }
}
