<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class insertMistakes extends config
{
    public $qid,$user,$uid;


    function __construct($qid=null, $user=null, $uid=null)
    {
        $this->qid=$qid;
        $this->user=$user;
        $this->uid=$uid;

    }
    public function insertMistakes()
    {
        $config = new config;
        $con = $config->con();
        $sql = "INSERT INTO tbl_incorrect(`question_id`,`username`,`user`) VALUES('$this->qid','$this->user',$this->uid)";
        $data = $con->prepare($sql);
        $data->execute();
    }

}