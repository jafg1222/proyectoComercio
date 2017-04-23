<?php		
		error_reporting(E_ERROR | E_PARSE);
		include_once('clsConexionOracle.php');
		include_once('passwordEncrypt.php');

		$data = file_get_contents("php://input");
		$valores = json_decode($data,TRUE);

		$conexion = new oracleConexion("mhacienda","12345","192.168.0.8/XE");

		$conex = $conexion->conectar();

		$sqlQuery = "INSERT INTO 
			PERSONA(NUMCEDULA,PERNOMBRE,PERPRIMAPE,PERSEGAPE,PERDIRECCION,PEREMAIL,PERNUMTELEFONO) 
			VALUES('".$valores['cedula']."','".$valores['nombre']."','".$valores['primApe']."','".$valores['segApe']."','".$valores['direcciones']."','".$valores['correo']."','".$valores['telefono']."')";			

		$execute = $conexion->execCrud($conex,$sqlQuery);

			if (is_bool($execute)){
				$sqlQuery = "";
				$numeroRegistro = rand(1,10000);
				$date = new DateTime();

				$sqlQuery = "INSERT INTO REGISTRO VALUES 
				('".$numeroRegistro."','".$valores['cedula']."',TO_DATE('".date_format($date,'Y-m-d H:i:s')."', 'yyyy/mm/dd hh24:mi:ss'))";

				$execute2 = $conexion->execCrud($conex,$sqlQuery);

					if (is_bool($execute2)) {
						$sqlQuery = "";
						$sqlQuery = "INSERT INTO FECHASACTIVIDADES VALUES ('".$numeroRegistro."','".$valores['fechaInicio']."','".$valores['fechaFin']."')";
						     $execute3 = $conexion->execCrud($conex,$sqlQuery);

						     if(is_bool($execute3)){
						     	$sqlQuery = "";

						     	$hash = new encryptPass();
								$hash->Password = $valores['pass'];
								$passEncrypt = $hash->Get_Hash_Pass();

								$sqlQuery = "INSERT INTO LOGIN VALUES('".$numeroRegistro."','".$passEncrypt."')";

								$execute4 = $conexion->execCrud($conex,$sqlQuery);

								if (is_bool($execute4)) {
											$res = openssl_pkey_new(array(
									        'private_key_bits' => 2048,      // Tamaño de la llave
									        'private_key_type' => OPENSSL_KEYTYPE_RSA,
								    ));
								    openssl_pkey_export($res, $privatekey);
								    $archivo = fopen("llaves/".$numeroRegistro."private.key","a") or die("error");fwrite($archivo,$privatekey);									
								    $publickey=openssl_pkey_get_details($res);
									$publickey=$publickey["key"];
									$archivo2 = fopen("llaves/".$numeroRegistro."public.key","a");
									fwrite($archivo2,$publickey);
									$end = date('Y/m/d h:m:s', strtotime('+1 years'));
									$sqlQuery = "";
									$sqlQuery = "INSERT INTO KEYS(NUMREGISTRO,PUBLICKEY,EXPDATE,KEYTYPE) VALUES('".$numeroRegistro."','".$privatekey."',TO_DATE('".$end."', 'yyyy/mm/dd hh24:mi:ss'),'PR')";
									$execute5 = $conexion->execCrud($conex,$sqlQuery);
									   if (is_bool($execute5)) {
									   	$sqlQuery = "";
									$sqlQuery = "INSERT INTO KEYS(NUMREGISTRO,PUBLICKEY,EXPDATE,KEYTYPE) VALUES('".$numeroRegistro."','".$publickey."',TO_DATE('".$end."', 'yyyy/mm/dd hh24:mi:ss'),'PU')";
									$execute6 = $conexion->execCrud($conex,$sqlQuery);
										if (is_bool($execute6)) {											
											$regisEncrypt = base64_encode($numeroRegistro);
											deliver_response(200, "OK", array("numeroRegistro"=>$regisEncrypt));
										}
									   }
									}else{
										deliver_response(400, "OK", array($sqlQuery));
									}
						     }
					}
							
			}else{

			}		
						








?>
