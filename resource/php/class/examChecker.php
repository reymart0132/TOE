<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class examChecker extends config
{
    public $id,$score,$name,$type,$status;



    function __construct($id=null, $score=null, $name=null, $type=null, $status=null)
    {
        $this->id=$id;
        $this->score=$score;
        $this->name=$name;
        $this->type=$type;
        $this->status=$status;
    }
    
    public function editUserExamPermission()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_accounts` SET `".$this->type."` = 1 WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function updateUserScore()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_accounts` SET `".$this->type."_score` = $this->score WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }

    public function insertScore()
    {
        $config = new config;
        $con = $config->con();
        $sql = "INSERT INTO `tbl_score`(`score`, `user`, `name`, `type`, `status`) VALUES ('$this->score','$this->id','$this->name','$this->type','$this->status')";
        $data = $con->prepare($sql);
        $data->execute();
    }


}