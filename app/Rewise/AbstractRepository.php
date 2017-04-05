<?php

namespace App\Rewise;

abstract class AbstractRepository {
  protected $model;
  protected $paginateNo;

  public function __construct() {
    $this->$paginateNo = 10;
  }

  public function index() {
    return $this->model::orderBy('created_at', 'desc')->paginate($this->paginateNo);
  }

  public function indexByUser(\App\User $user) {
    return $this->model::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate($this->paginateNo);
  }

  public function setPagination($pagination) {
    $this->paginateNo = $pagination;
  }

}
