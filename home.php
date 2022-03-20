<?php
  session_start();
  if(isset($_SESSION['username'])){

    echo"Sei già loggato con l'utente $_SESSION[username] <br><a href='logout.php'>clicca qui per sloggare link</a>";
  } 
  else{                       
      echo"<form action='$_SERVER[PHP_SELF]' method='post'>
      		<input type='text' name='user'> Username<br>
      		<input type='password' name='pass'> Password<br>
      		<input type='submit' name='ok' value='Accedi!'>
      </form>";
      if(isset($_POST['ok'])){

         include("config.php");
         $pass=md5($_POST['pass']);
         $query="select * from utente where username='$_POST[user]' and password='$pass';";
         $risultato=mysqli_query($conn,$query) or die("errore");
      	if(mysqli_num_rows($risultato)==1){
            $_SESSION['username']=$_POST['user'];
            $_SESSION['nuova_sessione']=true;
         	header("location:pagina.php");
         }
         else{
            echo"Username e/o password errate";
         }     
       }
    }
?>