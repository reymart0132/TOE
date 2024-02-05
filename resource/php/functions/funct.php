<?php
function CheckSuccessQuestion($status){
    if($status =='q1'){
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully inserted the question to the database!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }elseif($status =='qa'){
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully activated the question it will now appear on the exams!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }elseif($status =='qd'){
        echo '<div class="alert alert-warning alert-dismissible fade show col-12" role="alert">
                <b>Warning!</b> You have successfully deactivated the question it will not appear on the exams!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }elseif($status =='qdel'){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Warning!</b> You have successfully deleted the question!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }else{
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Warning!</b>Error Occured Please contact the developers!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}
function CheckSuccess($status){
    if($status =='Success'){
        echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
                <b>Congratulations!</b> You have successfully submitted your request!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
    }
}

function Success(){
    echo '<div class="alert alert-success alert-dismissible fade show col-12" role="alert">
            <b>Congratulations!</b> You have successfully registered! Please Proceed to Login Page.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
function loginError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid username/Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
function curpassError(){
        echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
                <b>Error!</b> Invalid Current Password
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }

function pError($error){
    echo '<div class="alert alert-danger alert-dismissible fade show col-12" role="alert">
            <b>Error!</b> '.$error.'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }

function vald(){
     if(Input::exists()){
      if(Token::check(Input::get('Token'))){
         if(!empty($_POST['College'])){
             $_POST['College'] = implode(',',Input::get('College'));
         }else{
            $_POST['College'] ="";
         }
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'username'=>array(
                'required'=>'true',
                'min'=>4,
                'max'=>20,
                'unique'=>'tbl_accounts'
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            ),
            'firstName'=>array(
                'required'=>'true'
            ),
            'lastName'=>array(
                'required'=>'true'
            ),
            'contactNumber'=>array(
                'required'=>'true',
            ),
            'email'=>array(
                'required'=>'true'
            ),
            'College'=>array(
                'required'=>'true'
            ),
            'age'=>array(
                'required'=>'true'
            ),
            'gender'=>array(
                'required'=>'true'
            ),
            'fullAddress'=>array(
                'required'=>'true'
            ),
            'town' => array(
                'required' => 'true'
            )));

            if($validate->passed()){
                $user = new user();
                $salt = Hash::salt(32);
                try {
                    $code = rand(1234,9999);
                    
                    
                    $user->create(array(
                        'username'=>Input::get('username'),
                        'password'=>Hash::make(Input::get('password'),$salt),
                        'salt'=>$salt,
                        'fname'=> Input::get('firstName'),
                        'lname'=> Input::get('lastName'),
                        'mname'=> Input::get('middleName'),
                        'phone'=> Input::get('contactNumber'),
                        'age'=> Input::get('age'),
                        'gender'=> Input::get('gender'),
                        'faddress'=> Input::get('fullAddress'),
                        'joined'=>date('Y-m-d H:i:s'),
                        'groups'=>1,
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email'),
                        'town'=> Input::get('town'),
                        'code'=> $code
                    ));

                } catch (Exception $e) {
                    die($e->getMessage());
                }

                Success();
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
            }
        }
            }else{
                return false;
            }
        }

        function logd(){
            if(Input::exists()){
                if(Token::check(Input::get('token'))){
                    $validate = new Validate();
                    $validation = $validate->check($_POST,array(
                        'username' => array('required'=>true),
                        'password'=> array('required'=>true)
                    ));
                    if($validation->passed()){
                        $user = new user();
                        $remember = (Input::get('remember') ==='on') ? true :false;
                        $login = $user->login(Input::get('username'),Input::get('password'),$remember);
                        if($login){
                            if($user->data()->groups == 1){
                                 Redirect::to('userdashboard.php');
                                echo $user->data()->groups;
                            }else if($user->data()->groups == 0){
                                Redirect::to('admindashboard.php');
                               echo $user->data()->groups;
                            }else{
                                 Redirect::to('logout.php');
                                echo $user->data()->groups;
                            }
                        }else{
                            loginError();
                        }
                    }else{
                        foreach($validation->errors() as $error){
                            echo $error.'<br />';
                        }
                    }
                }
            }
        }

        function isLogin(){
            $user = new user();
            if(!$user->isLoggedIn()){
                Redirect::to('login.php');
            }
        }

function profilePic(){
    $view = new view();
    if($view->getdpSRA()!=="" || $view->getdpSRA()!==NULL){
        echo "<img class='rounded-circle profpic img-thumbnail ml-3' alt='100x100' src='data:".$view->getMmSRA().";base64,".base64_encode($view->getdpSRA())."'/>";
    }else{
        echo "<img class='rounded-circle profpic img-thumbnail' alt='100x100' src='resource/img/user.jpg'/>";
    }
}

function updateProfile(){
    if(Input::exists()){
        if(!empty($_POST['College'])){
            $_POST['College'] = implode(',',Input::get('College'));
        }else{
           $_POST['College'] ="";
        }

        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'email'=>array(
                'required'=>'true',
                'min'=>5,
                'max'=>500,
            ),
            'College'=>array(
                'required'=>'true'
            )));

            if($validate->passed()){
                $user = new user();

                try {
                    $user->update(array(
                        'fname'=> Input::get('firstName'),
                        'mname'=> Input::get('middleName'),
                        'lname'=> Input::get('lastName'),
                        'age'=> Input::get('age'),
                        'phone'=> Input::get('phone'),
                        'faddress'=> Input::get('faddress'),
                        'colleges'=> Input::get('College'),
                        'email'=> Input::get('email'),
                        'town'=> Input::get('town')
                    ));
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                Redirect::to('userdashboard.php');
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
        }

    }
}

function changeP(){
    if(Input::exists()){
        $validate = new Validate;
        $validate = $validate->check($_POST,array(
            'password_current'=>array(
                'required'=>'true',
            ),
            'password'=>array(
                'required'=>'true',
                'min'=>6,
            ),
            'ConfirmPassword'=>array(
                'required'=>'true',
                'matches'=>'password'
            )));

            if($validate->passed()){
                $user = new user();
                if(Hash::make(Input::get('password_current'),$user->data()->salt) !== $user->data()->password){
                    curpassError();
                }else{
                    $user = new user();
                    $salt = Hash::salt(32);
                    try {
                        $user->update(array(
                            'password'=>Hash::make(Input::get('password'),$salt),
                            'salt'=>$salt
                        ));
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                    Redirect::to('logout.php');
                }
            }else{
                foreach ($validate->errors()as $error) {
                pError($error);
                }
        }
    }
}

function isUser($groups){
    if($groups==="1"){

    }else{
        header('HTTP/1.0 403 Forbidden');
        echo 'You are not allowed to access this page!';
        exit;
    }
}

function isActive($active)
{
    if ($active == "1") {

    } else {
        header('Location:activateuser.php');
    }
}

function isAdmin($groups){
    if($groups==="0"){

    }else{
        header('HTTP/1.0 403 Forbidden');
        echo 'You are not allowed to access this page!';
        exit;
    }
}

function getPassingScore($type){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `examconfig` WHERE `exam_type` = '$type'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['passingscore'];
}
function getExamName($exam){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `examconfig` WHERE `exam_type` = '$exam'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['value'];
}
function getExamDesc($exam){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `examconfig` WHERE `exam_type` = '$exam'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['desc'];
}
function getExamDuration($exam){
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `examconfig` WHERE `exam_type` = '$exam'";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['duration'];
}

function getQuestionCount($exam)
{
    $config = new config;
    $con = $config->con();
    $sql = "SELECT count(*) as `count` FROM `tbl_question` WHERE `type` = '$exam' AND `active` = 1";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['count'];
}

function findUserCourse($id)
{
    $config = new config;
    $con = $config->con();
    $sql = "SELECT * FROM `tbl_accounts` WHERE `id`= '$id' ";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['colleges'];
}
function findTowns()
{
    $config = new config;
    $con = $config->con();
    $sql = "SELECT DISTINCT town FROM `tbl_accounts` WHERE town IS NOT NULL";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $town){
        echo "<option value='$town[town]'>$town[town]</option>";
    }
}
function findQuestionID()
{
    $config = new config;
    $con = $config->con();
    $sql = "SELECT DISTINCT `question_id` FROM `tbl_correct` UNION SELECT DISTINCT `question_id` FROM `tbl_incorrect`  ";
    $data = $con->prepare($sql);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $qid){
        echo "<option value='$qid[question_id]'>Question-$qid[question_id]</option>";
    }
}
// function getExamType($id){
//     $config = new config;
//     $con = $config->con();
//     $sql = "SELECT * FROM `tbl_question` WHERE `id` = '$id'";
//     $data = $con->prepare($sql);
//     $data->execute();
//     $result = $data->fetchAll(PDO::FETCH_ASSOC);
//     return $result[0]['type'];
// }

function insertQuestion(){
    if (isset($_REQUEST['submit'])) {
        $content = $_REQUEST['content'];
        $type = $_REQUEST['type'];
        $choice1 = $_REQUEST['choice1'];
        $choice2 = $_REQUEST['choice2'];
        $choice3 = $_REQUEST['choice3'];
        $choice4 = $_REQUEST['choice4'];
        $choice5 = $_REQUEST['choice5'];
        $answer = $_REQUEST['answer'];

        $config = new config;
        $con = $config->con();
        $sql = "INSERT INTO `tbl_question` SET `question` = '$content',`type`='$type',`a`='$choice1',`b`='$choice2',`c`='$choice3',`d`='$choice4',`e`='$choice5',`answer`='$answer' ";
        $data = $con->prepare($sql);
        if ($data->execute()) {
            $msg = "The new Question has been inserted!";
            header('Location:eq.php?status=q1');
        } else {
            $msg = "Error";
        }
    }
}


function getTotalApplicant($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if($date1 !== null & $date2 !== null){
        $sql ="SELECT DATE(`joined`) AS `dit`, COUNT(`id`) AS `tots`
        FROM tbl_accounts
        WHERE `groups` = 1 
        AND DATE_FORMAT(`joined`, '%Y-%m') >= '$date1'
        AND DATE_FORMAT(`joined`, '%Y-%m') <= '$date2'
        GROUP BY DATE(`joined`)";
        }else{

            $sql = "SELECT DATE(`joined`) as `dit`,count(`id`) AS `tots` FROM tbl_accounts WHERE `groups` = 1 GROUP BY CAST(`joined` AS DATE)";
        }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getIncorrect($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null & $date2 !== null) {
        $sql = "SELECT `question_id`,COUNT(*) as `count` FROM `tbl_incorrect` WHERE DATE_FORMAT(`answer_date`, '%Y-%m') >= '$date1'
  AND DATE_FORMAT(`answer_date`, '%Y-%m') <= '$date2'
GROUP BY `question_id`";
    } else {
        $sql = "SELECT `question_id`,COUNT(*) as `count` FROM `tbl_incorrect` GROUP BY `question_id`";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getCorrect($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null & $date2 !== null) {
        $sql = "SELECT `question_id`,COUNT(*) as `count` FROM `tbl_correct` WHERE DATE_FORMAT(`answer_date`, '%Y-%m') >= '$date1'
  AND DATE_FORMAT(`answer_date`, '%Y-%m') <= '$date2'
GROUP BY `question_id`";
    } else {
        $sql = "SELECT `question_id`,COUNT(*) as `count` FROM `tbl_correct` GROUP BY `question_id`";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getTown($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null & $date2 !== null) {
        $sql = "SELECT `town`, COUNT(*) AS `count`
FROM `tbl_accounts`
WHERE `groups` = 1 
  AND DATE_FORMAT(`joined`, '%Y-%m') >= '$date1'
  AND DATE_FORMAT(`joined`, '%Y-%m') <= '$date2'
GROUP BY `town`";
    } else {
        $sql = "SELECT `town`,COUNT(*) as `count` FROM `tbl_accounts`  WHERE `groups` = 1 GROUP BY `town`";
    }
    $data = $con->prepare($sql);
    
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getGender($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null & $date2 !== null) {
        $sql = "SELECT `gender`,COUNT(*) as `count` FROM `tbl_accounts` WHERE `groups` = 1 
  AND DATE_FORMAT(`joined`, '%Y-%m') >= '$date1'
  AND DATE_FORMAT(`joined`, '%Y-%m') <= '$date2'
GROUP BY `gender`";
    } else {
        
        $sql = "SELECT `gender`,COUNT(*) as `count` FROM `tbl_accounts` WHERE `groups` = 1 GROUP BY `gender`";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getAge($date1=null,$date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null & $date2 !== null) {
        $sql = "SELECT `age`,COUNT(*) as `count` FROM `tbl_accounts` WHERE `groups` = 1 
  AND DATE_FORMAT(`joined`, '%Y-%m') >= '$date1'
  AND DATE_FORMAT(`joined`, '%Y-%m') <= '$date2'
GROUP BY `age`";
    } else {
        $sql = "SELECT `age`,COUNT(*) as `count` FROM `tbl_accounts`  WHERE `groups` = 1 GROUP BY `age`";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getAgeComplex($date1=null, $date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null ) {
        $sql = "SELECT DATE_FORMAT(joined, '%Y-%m') AS registration_month_year, SUM(CASE WHEN age BETWEEN 18 AND 24 THEN 1 ELSE 0 END) AS Young_Adult, SUM(CASE WHEN age BETWEEN 25 AND 29 THEN 1 ELSE 0 END) AS Twenties, SUM(CASE WHEN age BETWEEN 30 AND 39 THEN 1 ELSE 0 END) AS Thirties, SUM(CASE WHEN age BETWEEN 40 AND 49 THEN 1 ELSE 0 END) AS Forties, SUM(CASE WHEN age BETWEEN 50 AND 59 THEN 1 ELSE 0 END) AS Fifties, SUM(CASE WHEN age >= 60 THEN 1 ELSE 0 END) AS Seniors FROM tbl_accounts  WHERE DATE_FORMAT(joined, '%Y-%m') BETWEEN '$date1' AND '$date2' GROUP BY DATE_FORMAT(joined, '%Y-%m') ORDER BY DATE_FORMAT(joined, '%Y-%m')";
    } else {
        $sql = "SELECT DATE_FORMAT(joined, '%Y-%m') AS registration_month_year, SUM(CASE WHEN age BETWEEN 18 AND 24 THEN 1 ELSE 0 END) AS Young_Adult, SUM(CASE WHEN age BETWEEN 25 AND 29 THEN 1 ELSE 0 END) AS Twenties, SUM(CASE WHEN age BETWEEN 30 AND 39 THEN 1 ELSE 0 END) AS Thirties, SUM(CASE WHEN age BETWEEN 40 AND 49 THEN 1 ELSE 0 END) AS Forties, SUM(CASE WHEN age BETWEEN 50 AND 59 THEN 1 ELSE 0 END) AS Fifties, SUM(CASE WHEN age >= 60 THEN 1 ELSE 0 END) AS Seniors FROM tbl_accounts  GROUP BY DATE_FORMAT(joined, '%Y-%m') ORDER BY DATE_FORMAT(joined, '%Y-%m')";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getGenderComplex($date1=null, $date2=null)
{
    $config = new config;
    $con = $config->con();
    if ($date1 !== null && $date2 !== null) {
        $sql = "SELECT DATE_FORMAT(joined, '%Y-%m') AS registration_month_year, SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male, SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS Female, SUM(CASE WHEN gender = 'Other' THEN 1 ELSE 0 END) AS Other FROM tbl_accounts  WHERE DATE_FORMAT(joined, '%Y-%m') BETWEEN '$date1' AND '$date2' GROUP BY DATE_FORMAT(joined, '%Y-%m') ORDER BY DATE_FORMAT(joined, '%Y-%m');";
    } else {
        $sql = "SELECT DATE_FORMAT(joined, '%Y-%m') AS registration_month_year, SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male, SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS Female, SUM(CASE WHEN gender = 'Other' THEN 1 ELSE 0 END) AS Other FROM tbl_accounts GROUP BY DATE_FORMAT(joined, '%Y-%m') ORDER BY DATE_FORMAT(joined, '%Y-%m');";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getGeoComplex($town=null)
{
    $config = new config;
    $con = $config->con();
    if ($town !== null ) {
        $sql = "SELECT
            town,
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS Female,
            SUM(CASE WHEN gender NOT IN ('Male', 'Female') THEN 1 ELSE 0 END) AS Other
        FROM
            tbl_accounts
        WHERE
            town IS NOT NULL 
            AND town = '$town'
        GROUP BY
            town
        ORDER BY
            town;";
    } else {
        $sql = "SELECT
            town,
            SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) AS Male,
            SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) AS Female,
            SUM(CASE WHEN gender NOT IN ('Male', 'Female') THEN 1 ELSE 0 END) AS Other
        FROM
            tbl_accounts
        WHERE
            town IS NOT NULL
        GROUP BY
            town
        ORDER BY
            town;";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
function getPIAComplex($qid=null)
{
    $config = new config;
    $con = $config->con();
    if ($qid !== null ) {
        $sql = "SELECT question_id, SUM(CASE WHEN answer_type = 'Correct' THEN count ELSE 0 END) AS correct_count, SUM(CASE WHEN answer_type = 'Incorrect' THEN count ELSE 0 END) AS incorrect_count FROM ( SELECT question_id, 'Correct' AS answer_type, COUNT(*) AS count FROM tbl_correct GROUP BY question_id UNION ALL SELECT question_id, 'Incorrect' AS answer_type, COUNT(*) AS count FROM tbl_incorrect GROUP BY question_id ) AS subquery WHERE `question_id` ='$qid' GROUP BY question_id";
    } else {
        $sql = "SELECT question_id, SUM(CASE WHEN answer_type = 'Correct' THEN count ELSE 0 END) AS correct_count, SUM(CASE WHEN answer_type = 'Incorrect' THEN count ELSE 0 END) AS incorrect_count FROM ( SELECT question_id, 'Correct' AS answer_type, COUNT(*) AS count FROM tbl_correct GROUP BY question_id UNION ALL SELECT question_id, 'Incorrect' AS answer_type, COUNT(*) AS count FROM tbl_incorrect GROUP BY question_id ) AS subquery GROUP BY question_id";
    }
    $data = $con->prepare($sql);
    $data->execute();
    $rows = $data->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
 ?>
