<?php
	class Test {
		//muutujad ehk properties
		private $secret_value = 7;
		public $non_secret_value = 9;
		private $received_secret;
		
		//funktsioonid ehk methods
		function __construct($received_value) {
			echo "  Klass hakkas tööle  ";
			$this->received_secret = $this->secret_value * $received_value;
			echo "  saabunud väärtuse korrutis salajase arvuga on: " .$this->received_secret;
			$this->multiply();
		}
		
		function __destruct() {
			echo "  Klass lõpetas!  ";
		}
		
		private function multiply() {
			echo "  teine korrutis on: " .$this->secret_value * $this->non_secret_value;
		}
		
		public function reveal() {
			echo "  Salajane muutuja on " .$this->secret_value;
			
		}
		
		
	} //klassi lõpp



?>