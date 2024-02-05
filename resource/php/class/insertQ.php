<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class insertQ extends config
{
    public $question,$choice1,$choice2,$choice3,$choice4,$answer,$etype;



    function __construct($question=null, $choice1=null, $choice2=null, $choice3=null, $choice4=null, $answer=null, $etype=null)
    {
        $this->question=$question;
        $this->choice1=$choice1;
        $this->choice2=$choice2;
        $this->choice3=$choice3;
        $this->choice4=$choice4;
        $this->answer=$answer;
        $this->etype=$etype;
    }
    public function insertQuestions()
    {
        $config = new config;
        $con = $config->con();
        $sql = "INSERT INTO tbl_question(`question`,`a`,`b`,`c`,`d`,`answer`,`type`) VALUES('$this->question','$this->choice1','$this->choice2','$this->choice3','$this->choice4','$this->answer','$this->etype')";
        $data = $con->prepare($sql);
        $data->execute();
    }

}