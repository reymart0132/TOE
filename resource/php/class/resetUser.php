<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class resetUser extends config
{
    public $id;



    function __construct($id=null)
    {
        $this->id=$id;
    }
    public function resetScore1()
    {
        $config = new config;
        $con = $config->con();
        $sql = "UPDATE `tbl_accounts` SET `aptitude1`='0',`aptitude2`='0',`aptitude3`='0',`aptitude4`='0',`core`='0',`aptitude5`='0',`aptitude1_score`='0',`aptitude2_score`='0',`aptitude3_score`='0',`aptitude4_score`='0',`aptitude5_score`='0' WHERE `id` =$this->id";
        $data = $con->prepare($sql);
        // var_dump($data);
        // die();
        $data->execute();
    }
    public function resetScore2()
    {
        $config = new config;
        $con = $config->con();
        $sql = "DELETE FROM `tbl_score` WHERE `user` =$this->id";
        $data = $con->prepare($sql);
        $data->execute();
    }
    public function resetScore3()
    {
        $config = new config;
        $con = $config->con();
        $sql = "DELETE FROM `tbl_incorrect` WHERE `user` =$this->id";;
        $data = $con->prepare($sql);
        $data->execute();
    }

}