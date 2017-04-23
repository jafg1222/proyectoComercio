<!DOCTYPE html>
<html>
<head>
	<title>Modulo de Información</title>
	<!-- AngularJS Resource -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>
	<!-- Script APIREST Resource -->
	<script src="../scripts/script.js"></script>
	<!-- Jquery Resource -->
	<script src="../recursos/jquery-3.1.1.min.js"></script>
	<!-- Bootstrap Resource -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- css style Resource -->
	<link rel="stylesheet" type="text/css" href="../estilos/style.css">
	<!-- Website Font style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<!-- Google Fonts -->
	<script src="https://use.fontawesome.com/710c906195.js"></script>

	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <!-- bootstrap ui - AngularJS  -->
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>

    <!-- Prueba-->
    <script language="javascript" src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-animate.js"></script>

</head>
<body>
	<div class="container">
		<div class="row main">
			<div class="panel-heading">			
	            <div class="panel-title text-center">
	               	<h1 class="title"><img src="mh_logo.png"  style="width: 300px"></h1>
	               	<h1 class="title">Módulo de Información - Factura Digital</h1>	               	
	               	<h2 class="title">Información</h2>
	              	<hr/>	             
	            </div>	            
	        </div>
	        <div class="panel-headinge">	        	
	        </div>
	        <div class="main-login main-center">	        
	        <form class="form-horizontal" action="../genKey.php?registro=<?php echo $_GET['registro']?>" method="post" enctype="multipart/form-data" id="MyUploadForm">
	        <div class="form-group ">
	        <?php echo "<p class='lead'>Bienvenido al sistema de factura digital,de click sobre el boton de Generar llave para generar su llave publica, su numero de registro es el siguiente: ".base64_decode($_GET["registro"])."
	        <br>Por favor guarde en un lugar seguro los datos proporcionados por el Ministerio de Hacienda</p>"?>
	        	<button  class="btn btn-primary btn-lg btn-block login-button" id="btn" name="btn">Generar Llave</button>
	        	<input class="btn btn-primary btn-lg btn-block login-button" id="inp" type="button" value="Iniciar Sesión" onclick="location.href='index.html';" />	        
	        </div> 				
			</form>

	        </div>
		</div>
	</div>

</body>
</html>
