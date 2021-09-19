<?php
        session_start();
        $connect = mysqli_connect("localhost", "root", "E45pg876123", "characters");
		$classes = array("creatureclass", "playerclass", "diceroll",);
		foreach ($classes as $i => $class){
			include $classes[$i] . ".php";
        }
        $query = "SELECT * FROM tbl_characters WHERE name = '". $_SESSION['CharacterName']."' AND race = '".$_SESSION['RaceName']."'AND user_id = ".$_SESSION['id']."";
        $results = mysqli_query($connect, $query);
        if(mysqli_num_rows($results) > 0)
        {         
            while($row = mysqli_fetch_array($results))
            {
				$experience = $row['experience'];
                $name = $row['name'];
                $blank = NULL;
		        $health = $row['health'];
		        $damage = $row['damage'];
                $attributes = array($blank, $health, $damage);
                $player1 = new player($name);
                $player1->setAttributes($attributes);
            }
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
    <title>Game</title>
    <link rel="icon" 
      type="image" 
      href="img/dice.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  </head>
  <body>   
		<section class="slideshow" style="height:500px;">
		<div class="content">
			<div class="slider-content">
			<figure class="shadow"> 
		<img src="http://www.webdesigndev.com/wp-content/uploads/2015/07/The-Ice-cavern-by-refriedspinach.jpg">
			</figure>
			<figure class="shadow"><img src="C:/Users/Olcay/OneDrive/Masaüstü/asd.jpg"></figure>
			<figure class="shadow"><img src="https://i.pinimg.com/originals/08/b2/0f/08b20f2d451fef77cebab0ae273dd283.jpg"></figure>
			<figure class="shadow"><img src="https://images.hdqwalls.com/wallpapers/bthumb/deer-polygon-art-8k-am.jpg"></figure>
			<figure class="shadow"><img src="http://www.webdesigndev.com/wp-content/uploads/2015/07/The-Ice-cavern-by-refriedspinach.jpg"></figure>
			<figure class="shadow"><img src="https://cdn.wallpapersafari.com/86/48/wHpFRg.jpg"></figure>
			<figure class="shadow"><img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/e2c7758404315.560bcaeb3ce4e.jpg"></figure>
			<figure class="shadow"><img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_1200/8dc4a523607575.55deba70e5e71.jpg"></figure>
			<figure class="shadow"><img src="https://images.hdqwalls.com/wallpapers/bthumb/deer-polygon-art-8k-am.jpg"></figure>
			<figure class="shadow"><img src="https://images.hdqwalls.com/wallpapers/bthumb/deer-polygon-art-8k-am.jpg"></figure>
			</div>
		</div>
		</section>     
<?php
	function pause($x){
		ob_flush();
		flush();
		sleep($x);
	}
// Create dice object

$dice = new dice;
// Set the scene
?>
<div class='overflow-auto' style="margin:auto;width:30%;height:20%;">
<?php
echo "<br>You have begun your journey, " . $player1->name;
echo "<br>Your stats are: <br>Health: " . $player1->health . "<br>Damage: " . $player1->damage;
pause(3);
echo "<br>You enter a forest";
pause(2);

$randomValue = rand(1, 5);
switch($randomValue){
	case 1:
		$monster1 = new Wolf("Wolf");
	break;
	case 2:
		$monster1 = new Griffin("Griffin");
	break;
	case 3:
		$monster1 = new Giant("Giant");
	break;
	case 4:
		$monster1 = new Dragon("Dragon");
	break;
	case 5:
		$monster1 = new LegendaryMonster("Balrog");
	break;
}
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
		echo "<br>Your brave endeavours have come to an end, " . $player1->name
		. "<br> Would you like to play again? <a href='#' onClick='window.location.reload()''>yes</a>";
		break;
	}

	$damage = $player1->attack($dice->roll("1d6"));
	$monster1->takeDamage($damage);
	pause(2);
	echo "<br>The monster's health is now: " . $monster1->health;
	pause(2);

	if ($monster1->health <= 0){
		$player1->LevelUP($monster1->XP,$experience);
		$query = "UPDATE tbl_characters SET experience=$player1->experience,health=$player1->health,damage=$player1->damage WHERE name = '". $_SESSION['CharacterName']."' AND race = '".$_SESSION['RaceName']."'";
		mysqli_query($connect, $query);
        echo "<br>You have vanquished the beast, " . $player1->name . ".<br>You can now return to your village."
		. "<br> Would you like to play again? <a href='#' onClick='window.location.reload()''>yes</a>";
		break;
	}
}
?>
</div>

  </body>
</html>