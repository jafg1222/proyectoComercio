<?php	

	header("Content-Type:application/json");
	header("Accept:application/json");

	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));		

	switch ($method) {
		case 'GET':
			# code...
			break;

		case 'POST':
			if (sizeof($request == 1)){
				if ($request[0] == 'regis'){
					include_once("servicios/regis.php");
				}
				if ($request[0] == 'sign'){
					include_once("servicios/sign.php");
				}
			}
			break;
	}


/*----------------------------------------------------------------------*/
/*
/*----------------------------------------------------------------------*/

	function deliver_response($status, $status_message,$data){
    header("HTTP/1.1 $status $status_message");

    $response["status"]=$status;
    $response["status_message"]=$status_message;
    $response["data"]=$data;

    $json_response=json_encode($response);
    echo $json_response;
}


?>
