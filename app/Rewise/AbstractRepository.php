<?php

namespace App\Rewise;

abstract class AbstractRepository {
  protected $model;
  protected $paginateNo;

  public function __construct() {
    $this->$paginateNo = 10;
  }

  public function index() {
    return $this->model::paginate($this->paginateNo);
  }

  public function setPagination($pagination) {
    $this->paginateNo = $pagination;
  }

  abstract public function add(Array $arr);
}
