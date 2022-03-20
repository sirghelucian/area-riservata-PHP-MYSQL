<?php
	include('config.php');post
	echo"Modifica dati di accesso<form action='$_SERVER[PHP_SELF]' method='POST'>
				<input name='vecchio_user' value='$utente[username]'>
				<input name='vecchia_pass' value='$utente[password]'>
				<table border='1'>
					<tr><td>Username</td><td><input type='text' name='user' value='$utente[username]'></td></tr>
					<tr><td>Password</td><td><input type='password' name='pass'></td></tr>
					<input type='hidden' name='vecchia_pass' value='$utente[password]'>
					<tr><td colspan='2'><input type='submit' name='ok' value='invia'></td></tr>
				</table>
				</form>
	";	
	if(isset($_POST['ok'])){
		session_start();
		if(isset($_POST['user']))
			$us=$_POST['user'];
		else
			$us=$_POST['vecchio_user'];
		if(isset($_POST['pass']))
			$psw=md5($_POST['pass']);
		else
			$psw=$_POST['vecchia_pass'];
		$query="update utente set username='$user', password='$pass' where username='$_POST[vecchio_user]'";
		mysqli_query($conn,$query) or die("errore ".mysqli_error($conn));
		echo"aggiornamento completato, <a href='pagina.php'>torna indietro</a>";
	}
?>