<?php

  session_start();
  if(!isset($_SESSION['id_user'])){
  	
  	header("location: index.php");
    exit;
  }

?>


SEJA BEM VINDO!
<a href="sair.php">Sair</a>