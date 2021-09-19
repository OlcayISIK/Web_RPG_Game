<?php


class player{

			public $name;
			public $health;
			public $damage;
			public $experience;

	public function __construct($name){
			$this->name = $name;

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

	public function LevelUp($XP,$experience){
			$this->experience = $experience;
			$this->experience += $XP;
			if($this->experience < 100){
				echo "<br>Your Character Current Level is 1 <br>Your Character Current XP is". " ". $this->experience;
			}
			elseif($this->experience >= 100 && $this->experience < 300){
				$this->health +=50;
				$this->damage +=50;
				echo "<br>Your Character Current Level is 2 <br>Your Character Current XP is". " ". $this->experience;
			}
			elseif($this->experience >= 300 && $this->experience < 600){
				$this->health +=100;
				$this->damage +=100;
				echo "<br>Your Character Current Level is 3 <br>Your Character Current XP is". " ". $this->experience;
			}
			elseif($this->experience > 600){
				$this->health +=200;
				$this->damage +=200;
				echo "<br>Your Character Current Level is 4 <br>Your Character Current XP is". " ". $this->experience;
			}
	}

	public function TakeXP($XP){
		$this->experience += $XP;
		if($this->experience < 100){
			echo "<br>Your Character Current Level is 1 <br>Your Character Current XP is". " ". $this->experience;
		}
		elseif($this->experience >= 100 && $this->experience < 300){
			$this->health +=50;
			$this->damage +=50;
			echo "<br>Your Character Current Level is 2 <br>Your Character Current XP is". " ". $this->experience;
		}
		elseif($this->experience >= 300 && $this->experience < 600){
			$this->health +=100;
			$this->damage +=100;
			echo "<br>Your Character Current Level is 3 <br>Your Character Current XP is". " ". $this->experience;
		}
		elseif($this->experience > 600){
			$this->health +=200;
			$this->damage +=200;
			echo "<br>Your Character Current Level is 4 <br>Your Character Current XP is". " ". $this->experience;
		}
}


	public function attack($roll){
		echo "<br>You attack the monster! ";

		$damageDealt =  round($this->damage / 6 * $roll);

		echo "<br>You damage the monster for " . $damageDealt;

		return $damageDealt;

	}


	public function takeDamage($damage){
		$this->health -= $damage;
	}

}

class barbarian extends player{
	public $health = 110;
	public $damage = 100;
}

class rogue extends player{
	public $health = 100;
	public $damage = 100;
}

class warrior extends player{
	public $health = 100;
	public $damage = 110;
}

class archer extends player{
	public $health = 90;
	public $damage = 120;
}

class horseman extends player{
	public $health = 150;
	public $damage = 70;
}

class wizard extends player{
	public $health = 70;
	public $damage = 150;
}

?>