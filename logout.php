<?php
  include("config.php");
  session_start();	
  $query="update sessione set dataOra_logout=now() where utente='$_SESSION[username]'";
  mysqli_query($conn,$query);
  session_destroy();
  header("location:home.php");
?>