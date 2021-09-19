<?php
include("function.php");

interface game1Interface{
    public function setComputerValue();
    public function setResultValue($BetToken,$userid);
}

class game1Class implements game1Interface{
   
    private $choose=array(
        "Me" => "",
        "Computer" => "",
    );
    private $who_whon="";

    public function __construct($choose=array("",""))
    {
        $this->choose=$choose;
    }

    public function setComputerValue(){

        $sayi=rand(1,3);
        if($sayi==1)
        {
            $this->choose["Computer"]="rock";
        }
        else if($sayi==2)
        {
            $this->choose["Computer"]="paper";
        }
        else if($sayi==3)
        {
            $this->choose["Computer"]="scissors";
        }

        return $this->choose;
    }
    public function setResultValue($BetToken,$userid){
        $userdata=new DB_con();
        $conn = mysqli_connect("localhost","root","E45pg876123","characters");
        if($this->choose["Me"] == "rock" && $this->choose["Computer"]=="scissors")
        {
            $query= "UPDATE tbl_users SET token= token + ".$BetToken." * 2 WHERE id = ".$userid."";
            $who_whon="You Won";
        }
        else if($this->choose["Me"] == "paper" && $this->choose["Computer"]=="rock")
        {
            $query= "UPDATE tbl_users SET token= token + ".$BetToken." * 2 WHERE id = ".$userid."";
            $who_whon="You Won";
        }
        else if($this->choose["Me"] == "scissors" && $this->choose["Computer"]=="paper")
        {
            $query= "UPDATE tbl_users SET token= token + ".$BetToken." * 2 WHERE id = ".$userid."";
            $who_whon="You Won";
        }
        else if($this->choose["Me"] == "rock" && $this->choose["Computer"]=="rock")
        {
            $who_whon="No one Won";
        }
        else if($this->choose["Me"] == "paper" && $this->choose["Computer"]=="paper")
        {
            $who_whon="No one Won";
        }
        else if($this->choose["Me"] == "scissors" && $this->choose["Computer"]=="scissors")
        {
            $who_whon="No one Won";
        }
        else if($this->choose["Me"] == "" || $this->choose["Computer"]=="")
        {}
        else
        {
            $userdata->updateToken($BetToken,$userid);
            $userdata->SearchTable($userid);
            $who_whon="Computer Won";
        }
        mysqli_query($conn,$query);
        $userdata->SearchTable($userid);
        return $who_whon;
    }
}

?>