<?php

header('Content-type: text/html; charset=latin1_swedish_ci' , true );

  session_start();
  unset($_SESSION["nomusuario"]); 
  unset($_SESSION["rolusuario"]);
  session_destroy();
	header("location: index.php");
	exit;
?>