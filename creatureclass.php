<?php

class creature{

			public $creature;
			public $health;
			public $damage;
			public $XP;

	public function __construct($creature){
		$this->creature = $creature;
		echo "<center><h2>" . $creature . " ". "is appeared !!!</h2></center><br>";
	}

	public function setAttributes($attributes){

		foreach ($attributes  as $i => $attribute){
			if ($i = 1){
				$this->health = $attributes[$i];
			}
			if ($i = 2){
				$this->damage = $attributes[$i];
			}

		}

	}

	public function attack($roll){
		echo "<br>The monster attacks! ";

		$damageDealt =  round($this->damage / 6 * $roll);

		echo "<br>The monster damages you for " . $damageDealt;

		return $damageDealt;

	}
	
	public function takeDamage($damage){
		$this->health -= $damage;
	}

}
class Wolf extends creature{
	public $health = 20;
	public $damage = 30;
	public $XP = 50;
}

class Griffin extends creature{
	public $health = 80;
	public $damage = 90;
	public $XP = 100;
}

class Giant extends creature{
	public $health = 100;
	public $damage = 100;
	public $XP = 150;
}

class Dragon extends creature{
	public $health = 200;
	public $damage = 200;
	public $XP = 200;
}

class LegendaryMonster extends creature{
	public $health = 400;
	public $damage = 400;
	public $XP = 300;
}
?>