<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
require_once 'config.php';

class exam extends config{

    public $type,$x,$answer,$qid;
    function __construct($type = null)
    {
        $this->type = $type;
    }

    public function viewQuestions()
    {
        $config = new config;
        $con = $config->con();
        $sql = "SELECT * FROM `tbl_question` WHERE `type`='$this->type' and `active` ='1' ORDER BY RAND()";
        $data = $con->prepare($sql);
        $data->execute();
        $rows = $data->fetchAll(PDO::FETCH_OBJ);
        $x ='1';
        $answer =[];
        $qid=[];
        foreach ($rows as $row) {
            echo "<p><b>$x. $row->question</b><p>";
            echo "<input type='radio' name='question$row->id' value='a'/>a. $row->a<br>"; 
            echo "<input type='radio' name='question$row->id' value='b'/>b. $row->b<br>"; 
            echo "<input type='radio' name='question$row->id' value='c'/>c. $row->c<br>"; 
            echo "<input type='radio' name='question$row->id' value='d'/>d. $row->d<br>"; 
            echo "<input type='radio' name='question$row->id' value='e'/>e. $row->e<br>"; 
            echo "<input type='radio' name='question$row->id' style='display:none;' value='f' checked/>"; 
            echo "<hr class='border-1'>";
            $answer[] =$row->answer;
            $qid[]=$row->id;
            $x++;
        }
        $this->answer = $answer;
        $this->qid = $qid;
        $this->x = $x -1;

    }

    public function returnX(){
        return $this->x;
    }

    public function returnAnswer(){
        return $this->answer;
    }
    public function returnQid(){
        return $this->qid;
    }


}
