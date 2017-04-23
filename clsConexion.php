<?php
   //establece la conexion de la base de datos

  $conex= oci_connect('mhacienda','12345','10.40.63.143');

   if(!$conex)
{
       $err=oci_error();

       trigger_error(htmlentities($err['message'],ENT_QUOSTES),E_USER_ERROR);

}

 ?>
