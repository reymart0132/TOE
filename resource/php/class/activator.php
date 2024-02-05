<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class activator extends config
{
    public $id,$score,$name,$duration,$desc;



    function __construct($id=null,$score=null,$name=null,$duration=null,$desc=null)
    {
        $this->id=$id;
        $this->score=$score;
        $this->name=$name;
        $this->duration=$duration;
        $this->desc=$desc;
    }
    public function activate()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_question` SET `active` = 1 WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function activateUser()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_accounts` SET `active` = 1 WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function deactivate()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_question` SET `active` = 0 WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function editPassing()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `examconfig` SET `passingscore` = '$this->score',`value`='$this->name',`duration`='$this->duration',`desc`='$this->desc' WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function delete()
    {
        $config = new config;
        $con = $config->con();
        $sql = "DELETE FROM `tbl_question` WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }

}