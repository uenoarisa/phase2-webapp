<?php
require_once('dbconnect.php');

class Study {
  public $day;
  public $hours;

  public function get_day() {
      return $this->day;
  }

  public function get_hours() {
      return (int)$this->hours;
  }
}
  
  
  
  $studies = $pdo->query($sql)->fetchAll(\PDO::FETCH_CLASS);
  $formatted_study_data = array_map(function($study) {
      return [$study->get_day(), $study->get_hours()];
  }, $studies);
  $chart_data = json_encode($formatted_study_data);
  ?>

  <script src="./assets/top.js"></script> 
  <!-- <script src ="./assets/chart/chart.js"></script>  -->
