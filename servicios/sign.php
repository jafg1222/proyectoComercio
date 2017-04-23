<?php 
	
		include_once('clsConexionOracle.php');
		include_once('passwordEncrypt.php');

		$data = file_get_contents("php://input");
		$valores = json_decode($data,TRUE);

		$conexion = new oracleConexion("mhacienda","12345","192.168.0.8/XE");

		$conex = $conexion->conectar();

		$sqlQuery = "SELECT * FROM LOGIN WHERE NUMREGISTRO = '".$valores['numeroRegistro']."'";

		$execute = $conexion->execSelect($conex,$sqlQuery);

		while (oci_fetch($execute)) {		    
    		$passBD = oci_result($execute, 'PASSWORDD');
		}

		$hash = new encryptPass();
		
	    $hash->Password = $valores['pass'];		   
        $hash->Hash = $passBD;

    	$validation = $hash->validate_hash();

    	if ($validation == true) {
        	deliver_response(200, "OK", array("respuesta"=>"Ok"));
    	}else{
	        deliver_response(400, "OK", array("respuesta"=>false));
    	}




		

?>