<?php

class Markov{

	public $memory = [];
	public $antiMemory = [];
	private $memorise = true; 
	private $antiMemorise = false;
	private $mode = "memory";

	private $seperator = ' ';
	private $order = 4;

	public function __construct($order = 4, $seperator = ' ', $mode = 'memorise'){
		// Markov::setOrder()
		$this->setOrder($order);

		// Markov::setSeperator()
		$this->setSeperator($seperator);

		// Markov::setMode()
		$this->setMode($mode);
	}

	public function setOrder($order){
		// Validate: cannot be less than zero
		if($order < 0){
			// ERROR
			throw new Exception("Order cannot be negative");
		}else{
			// Set order
			$this->order = $order;
		}
	}

	public function setSeperator($seperator){
		$this->seperator = $seperator;
	}

	public function setMode($mode){

		switch (strtolower($mode)){
			case 'memorise':
				$this->mode = "memory";
				break;
			case 'antimemorise':
				$this->mode = "antiMemory";
				break;
			
			default:
				throw new Exception("Invalid Mode Type");
				break;
		}
	}

	///////////////////////////////

	public function learn($text){
		// Add ε (eplison) to the end of the string
		$text = $text . ' ε';

		// See Markov::breakText
		$this->breakText($text);
	}

	private function learnPart($key, $value){
		// Turn array into a string so it can
		// be used as a key in memory
		$key = implode(",", $key);

		// If the key doesn't already exist in memory, create it
		if(!isset($this->{$this->mode}[$key])){
			$this->{$this->mode}[$key] = [];
		}

		// Push the succeding value into memory where the key
		// is based on the previous number tokens of tokens
		// which is specified by the order
		array_push($this->{$this->mode}[$key], $value);

		return $this->{$this->mode};
	}

	private function breakText($text){
		// Split the input text into an array as specificed by
		// the seperator
		$parts = explode($this->seperator, $text);

		// Create an empty array based on the specificed order
		$prev = $this->generateInitial();

		// For each token, process that and store it in memory
		// See: Markov::learnPart
		foreach ($parts as $next) {
			$this->learnPart($prev, $next);
			array_shift($prev);
			array_push($prev, $next);
		}
	}

	public function generateInitial(){
		$return = [];

		$i = 0;
		while ($i <= $this->order) {
			array_push($return, '');
			$i++;
		}

		return $return;
	}


	//////////////////
	public function ask($seed = null){
		if(!isset($seed)){
			$seed = $this->generateInitial();
		}

		$return = array_merge($seed, $this->step($seed, []));

		foreach ($return as $key => $value){
			if(empty($value)){
				array_shift($return);
			}	
		}

		$return = implode($this->seperator, $return);

		$return = substr($return, 0, -2);

		return $return;
	}

	private function step($state, $return){
		$state = implode(",", $state);

		if(isset($this->memory[$state])){
			$nextAvailable = $this->memory[$state];
			$next = $this->memory[$state][array_rand($nextAvailable, 1)];
		}else{
			return $return;
		}

		array_push($return, $next);

		$nextState = array_slice(explode(",", $state), 1);
		array_push($nextState, $next);

		return $this->step($nextState, $return);
	}

}