<?php

namespace App\Rewise\Repository;

use App\Schedule;

class ScheduleRepo extends AbstractRepository {

  public function __construct() {
    $this->model = Schedule::class; 

  }

}

?>
