<?php 
		
		class encryptPass {
			public $Password;
			private $Salt;
			public $Hash;					

		public function setSalt($Salt){
			$this->Salt = $Salt;
		}
		public function getSalt($Salt){
			return $this->Salt;
		}

		public function setPassword($Password){
			$this->Password = $Password;
		}
		public function getPassword($Password){
			return $this->Password;
		}

		public function setHash($Hash){
			$this->Hash = $Hash;
		}		
		public function getHash($Hash){
			return $this->Hash;
		}

		function Get_Hash_Pass(){
			// Generar una cadena aleatoria de 22 caracteres
			$this->Salt = substr(base64_encode(openssl_random_pseudo_bytes('30')),0,22);
			// Sustituir los simbolos + 
			$this->Salt = strtr($this->Salt, array('+' => '.')); 
			// Generamos el hash
			return crypt($this->Password, '$2y$10$' . $this->Salt);						

		}
		function validate_hash(){
			if(crypt($this->Password,$this->Hash) == $this->Hash){
				return true;
			}else{
				return false;
			}
		}		


		}

?>