<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
require_once 'config.php';

class view extends config{

        public function collegeSP2(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `collegeschool`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->college_school.'." value="'.$row->college_school.'">'.$row->college_school.'</option>';
                  echo 'success';
                }
        }
        public function collegeSP3(){
            $config = new config;
            $con = $config->con();
            $sql = "SELECT * FROM `examconfig`";
            $data = $con-> prepare($sql);
            $data ->execute();
            $rows =$data-> fetchAll(PDO::FETCH_OBJ);
                foreach ($rows as $row) {
                  echo '<option data-tokens=".'.$row->exam_type.'." value="'.$row->id.'">'.$row->exam_type.'</option>';
                  echo 'success';
                }
        }

  public function townSP()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_town`";
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) {
      echo '<option data-tokens=".' . $row->town . '." value="' . $row->town . '">' . $row->town . '</option>';
      echo 'success';
    }
  }

        public function getdpSRA(){
            $user = new user();
            return $user->data()->dp;
        }

        public function getMmSRA(){
            $user = new user();
             return $user->data()->mm;
        }

}
