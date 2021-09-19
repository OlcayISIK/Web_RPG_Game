<?php
session_start();
include("RPSGameFunctions.php");


$choose=array(
    "Me" => "",
    "Computer" => "",
);

$who_whon="";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $BetToken = $_POST['BetToken'];
    $UserToken = $_SESSION['token'];
    $userid =  $_SESSION['id'];
    if($UserToken > $BetToken){
    if(isset($_POST["rockbtn"])){
        $choose["Me"]="rock";
    }
    else if(isset($_POST["paperbtn"])){
        $choose["Me"]="paper";
    }
    else if(isset($_POST["scissorsbtn"])){
        $choose["Me"]="scissors";
    }

    $compValue=new game1Class($choose);

    $choose=$compValue->setComputerValue();
    $who_whon=$compValue->setResultValue($BetToken,$userid);
    echo $_SESSION['token'];
    
    header("Location".$_SERVER['PHP_SELF']);
}else{
    echo "<script>alert('You Do Not Have Enough Token');</script>";
}
}
?>

<html>
<head>
<title>tas kagit makas</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <div class="container h-100">
    <form method="post">
            <div class="input-group mb-3" style="margin-top:10%" >
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Please Enter Your Bet</span>
                </div>
             <input type="number" name="BetToken" class="form-control" aria-label="Please Enter Your Bet" >
            </div>

        <div class="row text-center p-5">
            <div class="col-sm">
                <button type="submit" name="rockbtn"><img src="images/rock.png" alt="img1" style="height:100%;width:100%;"></button>
            </div>
            <div class="col-sm">
                <button type="submit" name="paperbtn"><img src="images/paper.png" alt="img2" style="height:100%;width:100%;"></button>
            </div>
            <div class="col-sm">
                <button type="submit" name="scissorsbtn"><img src="images/scissors.png" alt="img3" style="height:150%;width:100%;"></button>
            </div>
        </div>
        <div class="row text-center p-5">
            <div class="col-sm">
                <h2>Your choise</h2>
                <p><?php echo $choose["Me"]; ?></p>
            </div>
            <div class="col-sm">
                <h2>Computer choise</h2>
                <p><?php echo $choose["Computer"]; ?></p>
            </div>
        </div>
        <div class="row text-center p-3">
            <div class="col-sm">
                <h1><?php echo $who_whon; ?></h1>
            </div>
        </div>
    </form>
    <div class="row text-center p-5">
            <div class="col-sm">
                <form method="post" action="index.php">
                    <button type="submit" name="home_button" class="btn btn-danger">Home</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>