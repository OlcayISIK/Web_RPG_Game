<?php
		session_start();
		$connect = mysqli_connect("localhost", "root", "E45pg876123", "characters");
		if(isset($_POST['No'])){
			 $query = "DELETE FROM tbl_characters WHERE name = '".$_SESSION['CharacterName']."' AND race = '".$_SESSION['RaceName']."' AND qualification ='".$_SESSION['Qualification']."' AND user_id = ".$_SESSION['id']."";
			mysqli_query($connect, $query);
			header('location:index.php');
		}
		$classes = array("creatureclass", "playerclass", "diceroll","RPSGameFunctions");
		foreach ($classes as $i => $class){
			include $classes[$i] . ".php";
		}
				$characterName =  $_SESSION['CharacterName'];
				$qualification = $_SESSION['Qualification'];
				$race = $_SESSION['RaceName'];
				switch ($qualification) {
					case "Wizard":
							$player1 = new wizard($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "wizardimage.jpg";
							break;
						case "Warrior":
							$player1 = new warrior($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "warriorimage.jpg";
							break;
						case "Barbarian":
							$player1 = new barbarian($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "barbarianimage.png";
							break;
						case "Archer":
							$player1 = new archer($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "archerimage.jpg";
							break;
						case "Horseman":
							$player1 = new horseman($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "horsemanimage.png";
							break;
						case "Rogue":
							$player1 = new rogue($characterName);
							$extension = $qualification . $race . "." . "jpg";
							$Mainimage = "rogueimage.png";
							break;
						default:
						echo "<script type='text/javascript'>alert('Something Gone Wrong');</script>";
				}
				$randomValue = rand(1, 1);
				switch($randomValue){
					case 1:
						$monster1 = new Wolf("Wolf");
						$Monsterimage = "wolf.jpg";
						break;
					case 2:
						$monster1 = new Griffin("Griffin");
						$Monsterimage = "griffin.jpg";
						break;
					case 3:
						$monster1 = new Giant("Giant");
						$Monsterimage = "giant.jpg";
						break;
					case 4:
						$monster1 = new Dragon("Dragon");
						$Monsterimage = "dragon.jpg";
						break;
					case 5:
						$monster1 = new LegendaryMonster("Balrog");
						$Monsterimage = "balrog.jpg";
						break;
									}
?>	
<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/demo.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Game</title>
    <link rel="icon" 
      type="image" 
      href="img/dice.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body>  
	  <div>
  <section id="slider">
  <input type="radio" name="slider" id="s1">
  <input type="radio" name="slider" id="s2">
  <input type="radio" name="slider" id="s3" checked>
  <input type="radio" name="slider" id="s4">
  <input type="radio" name="slider" id="s5">
  <label for="s1" id="slide1">
  	<img src="images/<?php echo $Mainimage ?>" height="100%" width="100%">
  </label>
  <label for="s2" id="slide2">
  	  	<img src="images/<?php echo $extension ?>" height="100%" width="100%">
  </label>
  <label for="s3" id="slide3">
  	  	<img src="images/<?php echo $Monsterimage ?>" height="100%" width="100%">
  </label>
  <label for="s4" id="slide4">
  	  	<img src="images/view.jpg" height="100%" width="100%">
  </label>
  <label for="s5" id="slide5">
  	<img src="images/view2.jpg" height="100%" width="100%">
  </label>
								</div>
<?php
	function pause($x){
		ob_flush();
		flush();
		sleep($x);
	}
// Create dice object

$dice = new dice;
$userdata=new DB_con();

// Creates player with attributes
$player1->setAttributes($dice->rollAttributes($player1->health,$player1->damage));
// Set the scene
?>
<div style="background-color:red;width:35%;height:43%;float:left;" id="left"><img src="images/cave.jpg" height="100%" width="100%"></div>
<div style="background-color:red;width:35%;height:43%;float:right;"id="right"><img src="images/attack.jpg" height="100%" width="100%"></div>
<div style="overflow:auto;margin:auto;width:30%;height:43%;">
<center>
<?php
echo "<br>While You Travel in Mysterious Cave";
echo "<br>Suddenly You Heard Something <br>";
pause(2);
echo "<br>You have to Defend Yourself, " . $player1->name . "<br>" . $monster1->creature. " " . "is Attacking !!";
echo "<br>Your stats are: <br>Health: " . $player1->health . "<br>Damage: " . $player1->damage;
pause(3);
// Create monster
$monster1->setAttributes($dice->rollAttributes($monster1->health,$monster1->damage));
pause(1);
echo "<br>The monster's stats are: <br>Health: " . $monster1->health . "<br>Damage: " . $monster1->damage;
pause(3);


// Attack sequence
while (($player1->health > 0) && ($monster1->health > 0)){

	$damage = $monster1->attack($dice->roll("1d6"));
	$player1->takeDamage($damage);
	pause(2);
	echo "<br>Your health is now: " . $player1->health;
	pause(2);

	if ($player1->health <= 0){
		?>
		<script>
		document.getElementById("right").innerHTML= '<img src="images/victory.png" height="100%" width="100%">';
		</script> 
		<label for="exampleInput1">Your brave endeavours have come to an end, <?php $player1->name ?>, Would you like to play again? </label>
		<button type="submit" onClick='window.location.reload()' class="btn btn-primary">Yes</button>
		<form method="POST">
		<button type="submit" name="No" formaction="game.php" class="btn btn-primary">No</button>
		</form>
		<?php
		break;
	}

	$damage = $player1->attack($dice->roll("1d6"));
	$monster1->takeDamage($damage);
	pause(2);
	echo "<br>The monster's health is now: " . $monster1->health;
	pause(2);

	if ($monster1->health <= 0){
		?>
		<script>
		document.getElementById("right").innerHTML= '<img src="images/victory.png" height="100%" width="100%">';
		</script> 
		<?php
		$player1->TakeXP($monster1->XP);	
	    $query = "UPDATE tbl_characters SET experience=$player1->experience,health=$player1->health,damage=$player1->damage WHERE name = '". $_SESSION['CharacterName']."' AND race = '".$_SESSION['RaceName']."' AND user_id = ".$_SESSION['id']."";
		$query2= "UPDATE tbl_users SET token= token + 10 WHERE id = ".$_SESSION['id']."";
		mysqli_query($connect, $query);
		mysqli_query($connect, $query2);
		$userdata->SearchTable($_SESSION['id']);
		?>
		<form method="POST">
		<div class="form-group">
			<label for="exampleInput1">You have vanquished the beast <?php $player1->name ?>, Do You Want to Move on ? </label>
			<button type="submit" formaction ="game2.php" name="MoveOn" class="btn btn-primary">Yes</button>
			<button type="submit" formaction="index.php" class="btn btn-primary">No</button>
		</div>
		</form>
		<?php
		break;
	}
}
?>
</center>
</div>
  </body>
</html>
