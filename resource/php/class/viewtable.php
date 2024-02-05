<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
require_once 'config.php';

class viewtable extends config{ 


public function viewExamTable(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_question`";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> View All Examination Questions </h3>";
  echo "<div class='table-responsive'>";
  echo "<table id='examTable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th class=' '>Exam ID</th>";
  echo "<th>Exam Question</th>";
  echo "<th style='font-size: 85%; class=' '>Choice 1</th>";
  echo "<th style='font-size: 85%; class=' '>Choice 2</th>";
  echo "<th style='font-size: 85%; class=' '>Choice 3</th>";
  echo "<th style='font-size: 85%;'>Choice 4</th>";
  
  echo "<th style='font-size: 85%;'>Answer</th>";
  echo "<th style='font-size: 85%;'>Exam Type</th>";
  echo "<th style='font-size: 85%;'>Active Status</th>";
  echo "<th style='font-size: 85%;'>Action</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[id]</td>";
  echo "<td style='font-size: 85%;'>$data[question]</td>";
  if($data['a']){
    echo "<td class=' ' style='font-size: 85%;'>".$data['a']."</td>";
  }else{
    echo "<td class='text-danger' style='font-size: 85%;'>No Answer Assigned yet</td>";
  }
  if($data['b']){
    echo "<td class=' ' style='font-size: 85%;'>".$data['b']."</td>";
  }else{
    echo "<td class='text-danger' style='font-size: 85%;'>No Answer Assigned yet</td>";
  }
  if($data['c']){
    echo "<td class=' ' style='font-size: 85%;'>".$data['c']."</td>";
  }else{
    echo "<td class='text-danger' style='font-size: 85%;'>No Answer Assigned yet</td>";
  }
  if($data['d']){
    echo "<td class=' ' style='font-size: 85%;'>".$data['d']."</td>";
  }else{
    echo "<td class='text-danger' style='font-size: 85%;'>No Answer Assigned yet</td>";
  }
  


  if ($data['answer']) {
        echo "<td class=' '>" . strtoupper($data['answer']) . "</td>";
  } else {
    echo "<td class='text-danger' style='font-size: 85%;'><b>No correct answer </b>assigned yet</td>";
  }
  if ($data['type']) {
    echo "<td class=' ' style='font-size: 85%;'>" . $data['type'] . "</td>";
  } else {
    echo "<td class='text-danger' style='font-size: 85%;'>No Type Assigned yet</td>";
  }
  echo "<td class=' '>$data[active]</td>";
  if($data['active']== 1){
    echo "<td>
              <a href='qDeactivator.php?id=$data[id]' class='btn btn-warning btn-sm col-12 mt-1'><i class='fa fa-edit'></i>Deactivate</a>
              <a href='qDeleter.php?id=$data[id]' class='btn btn-danger btn-sm col-lg-12 mt-1'><i class='fa fa-trash'></i>Remove Question</a>
          </td>";
  }else{
        echo "<td>
            <a href='qActivator.php?id=$data[id]' class='btn btn-success btn-sm col-12 mt-1'><i class='fa fa-edit'></i>Activate</a>
            <a href='qDeleter.php?id=$data[id]' class='btn btn-danger btn-sm col-lg-12 mt-1'><i class='fa fa-trash'></i>Remove Question</a>
        </td>";
  }
  

  
  echo "</tr>";
  }
  echo "</table>";

}
public function viewConfigTable(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `examconfig`";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> View All Examination Config </h3>";
  echo "<table id='examTable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Exam Type</th>";
  echo "<th class=' '>Exam Name</th>";
  echo "<th style='font-size: 85%; class=' '>Passing Score</th>";
  echo "<th style='font-size: 85%; class=' '>Duration in Minutes</th>";
  echo "<th style='font-size: 85%; class=' '>Description</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td style='font-size: 85%;'>$data[exam_type]</td>";
  echo "<td style='font-size: 85%;'>$data[value]</td>";
  echo "<td class=' ' style='font-size: 85%;'>".$data['passingscore']."</td>";
  echo "<td class=' ' style='font-size: 85%;'>".$data['duration']."</td>";
  echo "<td class=' ' style='font-size: 85%;'>".$data['desc']."</td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }
public function viewScoringTable(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_score`";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> By Exam-Based Score Table </h3>";
  echo "<table id='examTable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Type</th>";
  echo "<th>Score</th>";
  echo "<th>Status</th>";
  echo "<th>Examination Date</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[name]</td>";
  echo "<td style='font-size: 85%;'>".getExamName($data['type'])."</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[score]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[status]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[date_taken]</td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }

  public function viewPIA()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_incorrect`";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3 class='text-center'> Point Item Analysis Table </h3>";
    echo "<table id='examTable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
    echo "<thead class='thead-dark'>";
    echo "<th>Question ID</th>";
    echo "<th>User who Answered Incorrectly</th>";
    echo "<th>Date Answered</th>";
    echo "<th>User Course</th>";
    echo "</thead>";
    foreach ($result as $data) {
      echo "<tr>";
      echo "<td class=' ' >Question - $data[question_id]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[username]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[answer_date]</td>";
      echo "<td class=' ' style='font-size: 85%;'>".findUserCourse($data['user'])."</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  public function viewPIA2()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_correct`";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3 class='text-center'> Point Item Analysis Table </h3>";
    echo "<table id='examTable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
    echo "<thead class='thead-dark'>";
    echo "<th>Question ID</th>";
    echo "<th>User who Answered Correctly</th>";
    echo "<th>Date Answered</th>";
    echo "<th>User Course</th>";
    echo "</thead>";
    foreach ($result as $data) {
      echo "<tr>";
      echo "<td class=' ' >Question - $data[question_id]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[username]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[answer_date]</td>";
      echo "<td class=' ' style='font-size: 85%;'>".findUserCourse($data['user'])."</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  public function viewTown()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = '1'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3 class='text-center'> Geographic Data of Users </h3>";
    echo "<table id='examTable3' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
    echo "<thead class='thead-dark'>";
    echo "<th>Name</th>";
    echo "<th>Course</th>";
    echo "<th>Email Address</th>";
    echo "<th>Home Address (Town)</th>";
    echo "</thead>";
    foreach ($result as $data) {
      echo "<tr>";
      echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[email]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[town]</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  public function viewGender()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = '1'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3 class='text-center'> Geographic Data of Users </h3>";
    echo "<table id='examTable3' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
    echo "<thead class='thead-dark'>";
    echo "<th>Name</th>";
    echo "<th>Course</th>";
    echo "<th>Email Address</th>";
    echo "<th>Gender</th>";
    echo "</thead>";
    foreach ($result as $data) {
      echo "<tr>";
      echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[email]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[gender]</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  public function viewAge()
  {
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` = '1'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3 class='text-center'> Geographic Data of Users </h3>";
    echo "<table id='examTable3' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
    echo "<thead class='thead-dark'>";
    echo "<th>Name</th>";
    echo "<th>Course</th>";
    echo "<th>Email Address</th>";
    echo "<th>Age</th>";
    echo "</thead>";
    foreach ($result as $data) {
      echo "<tr>";
      echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[email]</td>";
      echo "<td class=' ' style='font-size: 85%;'>$data[age]</td>";
      echo "</tr>";
    }
    echo "</table>";
  }


public function viewUserTable2(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` =1";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Examination Score Table </h3>";
  echo "<table id='examTable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Username</th>";
  echo "<th>Email</th>";
  echo "<th>Scores</th>";
  echo "<th>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
  echo "<td style='font-size: 85%;'>$data[username]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[email]</td>";
  echo "<td class=' ' style='font-size: 85%;'><b>
  ".getExamName('aptitude1').": $data[aptitude1_score] out of ". getQuestionCount('aptitude1')."</b><br>
  <b>".getExamName('aptitude2').": $data[aptitude2_score] out of ". getQuestionCount('aptitude2')."</b><br>
  <b>".getExamName('aptitude3').": $data[aptitude3_score] out of ". getQuestionCount('aptitude3')."</b><br>
  <b>".getExamName('aptitude4').": $data[aptitude4_score] out of ". getQuestionCount('aptitude4')."</b><br>
  <b>".getExamName('aptitude5').": $data[aptitude5_score] out of ". getQuestionCount('aptitude5')."</b><br>
  </td>";
  echo "<td class=' ' style='font-size: 85%;'>
    <a href='resetUser.php?id=$data[id]' class='btn btn-info'>User Reset All Exam</a>
    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] ".substr($data['mname'], 0, 1)." - Tesda Exam Result&body=Goodmorning!%0D%0A%0D%0AWe have completed and reviewed your result!%0D%0A%0D%0ATotal Break down of your result is listed below:%0D%0A %0D%0A". getExamName('aptitude1')." - $data[aptitude1_score] out of " . getQuestionCount('aptitude1') . " %0D%0A" . getExamName('aptitude1') . " - $data[aptitude2_score] out of " . getQuestionCount('aptitude2') . " %0D%0A " . getExamName('aptitude3') . " - $data[aptitude3_score] out of " . getQuestionCount('aptitude3') . " %0D%0A " . getExamName('aptitude4') . " - $data[aptitude4_score] out of " . getQuestionCount('aptitude4') . " %0D%0A " . getExamName('aptitude5') . " - $data[aptitude5_score] out of " . getQuestionCount('aptitude5') . " %0D%0A  %0D%0APayments can be made through this link %0D%0A https://ptipages.paynamics.net/ceu/default.aspx %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-lg-3 my-1'><i class='fa fa-envelope-open-text'></i> Mail Results</a>
  </td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }
  
  
  
  
  public function viewNewUsersToday(){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` =1 AND DATE(`joined`) = CURDATE()";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> New User (Today) Score Table </h3>";
  echo "<table id='examTable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Qualification</th>";
  echo "<th>Summary</th>";
  echo "<th>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
  echo "<td class=' ' style='font-size: 75%;'>
  " . getExamName('aptitude1') . ": <b>$data[aptitude1_score] out of " . getQuestionCount('aptitude1') . "</b><br>
  " . getExamName('aptitude2') . ": <b>$data[aptitude2_score] out of " . getQuestionCount('aptitude2') . "</b><br>
  " . getExamName('aptitude3') . ": <b>$data[aptitude3_score] out of " . getQuestionCount('aptitude3') . "</b><br>
  " . getExamName('aptitude4') . ": <b>$data[aptitude4_score] out of " . getQuestionCount('aptitude4') . "</b><br>
  " . getExamName('aptitude5') . ": <b>$data[aptitude5_score] out of " . getQuestionCount('aptitude5') . "</b><br>
  </td>";
  echo "<td class=' ' style='font-size: 85%;'>
    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] ".substr($data['mname'], 0, 1)." - Tesda Exam Result&body=Goodmorning!%0D%0A%0D%0AWe have completed and reviewed your result!%0D%0A%0D%0ATotal Break down of your result is listed below:%0D%0A %0D%0A" . getExamName('aptitude1') . " - $data[aptitude1_score] out of " . getQuestionCount('aptitude1') . " %0D%0A" . getExamName('aptitude1') . " - $data[aptitude2_score] out of " . getQuestionCount('aptitude2') . " %0D%0A " . getExamName('aptitude3') . " - $data[aptitude3_score] out of " . getQuestionCount('aptitude3') . " %0D%0A " . getExamName('aptitude4') . " - $data[aptitude4_score] out of " . getQuestionCount('aptitude4') . " %0D%0A " . getExamName('aptitude5') . " - $data[aptitude5_score] out of " . getQuestionCount('aptitude5') . " %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i></a><br>
    <a href='resetUser.php?id=$data[id]' class='btn btn-info col-12'><i class='fa fa-edit'></i></a>
  </td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }
  public function viewUsers(){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` =1";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> User Control Table </h3>";
  echo "<table id='examTable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Qualification</th>";
  echo "<th>Town</th>";
  echo "<th>Age</th>";
  echo "<th>Gender</th>";
  echo "<th>Summary</th>";
  echo "<th>Actions</th>";
  echo "</thead>"; 
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[town]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[age]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[gender]</td>";
  echo "<td class=' ' style='font-size: 75%;'>
  " . getExamName('aptitude1') . ": <b>$data[aptitude1_score] out of " . getQuestionCount('aptitude1') . "</b><br>
  " . getExamName('aptitude2') . ": <b>$data[aptitude2_score] out of " . getQuestionCount('aptitude2') . "</b><br>
  " . getExamName('aptitude3') . ": <b>$data[aptitude3_score] out of " . getQuestionCount('aptitude3') . "</b><br>
  " . getExamName('aptitude4') . ": <b>$data[aptitude4_score] out of " . getQuestionCount('aptitude4') . "</b><br>
  " . getExamName('aptitude5') . ": <b>$data[aptitude5_score] out of " . getQuestionCount('aptitude5') . "</b><br>
  </td>";
  echo "<td class=' ' style='font-size: 85%;'>
    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] ".substr($data['mname'], 0, 1)." - Tesda Exam&body=Goodmorning!%0D%0A%0D%0AWe you have successfully registered to TESDA Exam!%0D%0A%0D%0APlease login to our system and enter the code below:%0D%0A $data[code] %0D%0A %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-success btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i>Email Security Code</a><br>

    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] " . substr($data['mname'], 0, 1) . " - Tesda Exam Result&body=Goodmorning!%0D%0A%0D%0AWe have completed and reviewed your result!%0D%0A%0D%0ATotal Break down of your result is listed below:%0D%0A %0D%0A" . getExamName('aptitude1') . " - $data[aptitude1_score] out of " . getQuestionCount('aptitude1') . " %0D%0A" . getExamName('aptitude1') . " - $data[aptitude2_score] out of " . getQuestionCount('aptitude2') . " %0D%0A " . getExamName('aptitude3') . " - $data[aptitude3_score] out of " . getQuestionCount('aptitude3') . " %0D%0A " . getExamName('aptitude4') . " - $data[aptitude4_score] out of " . getQuestionCount('aptitude4') . " %0D%0A " . getExamName('aptitude5') . " - $data[aptitude5_score] out of " . getQuestionCount('aptitude5') . " %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i>Email Score Result</a><br>

    <a href='resetUser.php?id=$data[id]' class='btn btn-info col-12'><i class='fa fa-edit'></i> Reset User</a>
  </td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }
  public function viewUsers2(){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` =1  AND DATE(`joined`) = CURDATE()";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> User Control Table </h3>";
  echo "<table id='examTable2' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Qualification</th>";
  echo "<th>Town</th>";
  echo "<th>Age</th>";
  echo "<th>Gender</th>";
  echo "<th>Summary</th>";
  echo "<th>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[colleges]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[town]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[age]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[gender]</td>";
  echo "<td class=' ' style='font-size: 75%;'>
  " . getExamName('aptitude1') . ": <b>$data[aptitude1_score] out of " . getQuestionCount('aptitude1') . "</b><br>
  " . getExamName('aptitude2') . ": <b>$data[aptitude2_score] out of " . getQuestionCount('aptitude2') . "</b><br>
  " . getExamName('aptitude3') . ": <b>$data[aptitude3_score] out of " . getQuestionCount('aptitude3') . "</b><br>
  " . getExamName('aptitude4') . ": <b>$data[aptitude4_score] out of " . getQuestionCount('aptitude4') . "</b><br>
  " . getExamName('aptitude5') . ": <b>$data[aptitude5_score] out of " . getQuestionCount('aptitude5') . "</b><br>
  </td>"; 

  //email security code
  echo "<td class=' ' style='font-size: 85%;'>
    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] ".substr($data['mname'], 0, 1)." - Tesda Exam&body=Goodmorning!%0D%0A%0D%0AWe you have successfully registered to TESDA Exam!%0D%0A%0D%0APlease login to our system and enter the code below:%0D%0A $data[code] %0D%0A %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-success btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i>Email Security Code</a><br>

    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] " . substr($data['mname'], 0, 1) . " - Tesda Exam Result&body=Goodmorning!%0D%0A%0D%0AWe have completed and reviewed your result!%0D%0A%0D%0ATotal Break down of your result is listed below:%0D%0A %0D%0A" . getExamName('aptitude1') . " - $data[aptitude1_score] out of " . getQuestionCount('aptitude1') . " %0D%0A" . getExamName('aptitude1') . " - $data[aptitude2_score] out of " . getQuestionCount('aptitude2') . " %0D%0A " . getExamName('aptitude3') . " - $data[aptitude3_score] out of " . getQuestionCount('aptitude3') . " %0D%0A " . getExamName('aptitude4') . " - $data[aptitude4_score] out of " . getQuestionCount('aptitude4') . " %0D%0A " . getExamName('aptitude5') . " - $data[aptitude5_score] out of " . getQuestionCount('aptitude5') . " %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i>Email Score Result</a><br>

    <a href='resetUser.php?id=$data[id]' class='btn btn-info col-12'><i class='fa fa-edit'></i> Reset User</a>
  </td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }


public function viewUserTable(){
  $config = new config;
  $con = $config->con();
  $sql = "SELECT * FROM `tbl_accounts` WHERE `groups` =1";
  $data = $con->prepare($sql);
  $data->execute();
  $result = $data->fetchAll(PDO::FETCH_ASSOC);
  echo "<h3 class='text-center'> Account Based Score Table </h3>";
  echo "<table id='examTable' class='table table-bordered table-sm table-bordered table-hover shadow display' width='100%'>";
  echo "<thead class='thead-dark'>";
  echo "<th>Name</th>";
  echo "<th>Qualification</th>";
  echo "<th>Email</th>";
  echo "<th style='font-size: 65%;'>".getExamName('aptitude1')."</th>";
  echo "<th style='font-size: 65%;'>".getExamName('aptitude2')."</th>";
  echo "<th style='font-size: 65%;'>".getExamName('aptitude3')."</th>";
  echo "<th style='font-size: 65%;'>".getExamName('aptitude4')."</th>";
  echo "<th style='font-size: 65%;'>".getExamName('aptitude5')."</th>";
  echo "<th>Summary</th>";
  echo "<th>Actions</th>";
  echo "</thead>";
  foreach ($result as $data) {
  echo "<tr>";
  echo "<td class=' ' >$data[fname] $data[lname] ".substr($data['mname'], 0, 1)."</td>";
  echo "<td style='font-size: 85%;'>$data[colleges]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[email]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[aptitude1_score]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[aptitude2_score]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[aptitude3_score]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[aptitude4_score]</td>";
  echo "<td class=' ' style='font-size: 85%;'>$data[aptitude5_score]</td>";
  echo "<td class=' ' style='font-size: 75%;'>
  " . getExamName('aptitude1') . ": <b>$data[aptitude1_score] out of " . getQuestionCount('aptitude1') . "</b><br>
  " . getExamName('aptitude2') . ": <b>$data[aptitude2_score] out of " . getQuestionCount('aptitude2') . "</b><br>
  " . getExamName('aptitude3') . ": <b>$data[aptitude3_score] out of " . getQuestionCount('aptitude3') . "</b><br>
  " . getExamName('aptitude4') . ": <b>$data[aptitude4_score] out of " . getQuestionCount('aptitude4') . "</b><br>
  " . getExamName('aptitude5') . ": <b>$data[aptitude5_score] out of " . getQuestionCount('aptitude5') . "</b><br>
  </td>";
  echo "<td class=' ' style='font-size: 85%;'>
    <a href='https://mail.google.com/mail/?view=cm&fs=1&to=$data[email]&su= $data[fname] $data[lname] ".substr($data['mname'], 0, 1)." - Tesda Exam Result&body=Goodmorning!%0D%0A%0D%0AWe have completed and reviewed your result!%0D%0A%0D%0ATotal Break down of your result is listed below:%0D%0A %0D%0A" . getExamName('aptitude1') . " - $data[aptitude1_score] out of " . getQuestionCount('aptitude1') . " %0D%0A" . getExamName('aptitude1') . " - $data[aptitude2_score] out of " . getQuestionCount('aptitude2') . " %0D%0A " . getExamName('aptitude3') . " - $data[aptitude3_score] out of " . getQuestionCount('aptitude3') . " %0D%0A " . getExamName('aptitude4') . " - $data[aptitude4_score] out of " . getQuestionCount('aptitude4') . " %0D%0A " . getExamName('aptitude5') . " - $data[aptitude5_score] out of " . getQuestionCount('aptitude5') . " %0D%0A %0D%0A * If you have any other concerns please let us know.%0D%0A %0D%0A Thank you and Stay safe!' target='_blank' class='btn btn-dark btn-sm col-12 my-1'><i class='fa fa-envelope-open-text'></i> Mail Results</a><br>
    <a href='resetUser.php?id=$data[id]' class='btn btn-info col-12'>User Reset All Exam</a>
  </td>";
  echo "</tr>"; 
  }
  echo "</table>";
  }

}
?>

