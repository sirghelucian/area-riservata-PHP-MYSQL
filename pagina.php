<?php
	include("config.php");
	session_start();
	if(isset($_SESSION['username'])){
		$operazioni=array();
		$query1="select * from utente where username='$_SESSION[username]';";
        $risultato=mysqli_query($conn,$query1) or die("errore");
        $utente=mysqli_fetch_array($risultato);//recupero i dati dell'utente loggato
        $query2="select * from operazione where livello='$utente[livello]';"; 
		$risultato=mysqli_query($conn,$query2) or die("errore".mysqli_error($conn));//controllo quali operazioni può effettuare l'utente
		$query3="select * from sessione where utente='$_SESSION[username]' order by dataOra_login desc";
        
		echo"Buongiorno $utente[username], (livello d'accesso $utente[livello]) Le azioni che ti sono consentite/vietate sono: <br>";
		$cont=0;
		while($operazioni_utente=mysqli_fetch_array($risultato)){
			echo $operazioni_utente['tipo'];
			if($operazioni_utente['consentito']=='SI'){
				echo "-consentito<br>";
				array_push($operazioni,$operazioni_utente['tipo']);
			}
			else
				echo "-vietato<br>";
		}    
		$risultato=mysqli_query($conn,$query3) or die("errore".mysqli_error($conn)); //recupero i dati dell'ultima sessione dell'utente
		$ultima_sessione=mysqli_fetch_array($risultato);
		
		echo"<br><br><br>Ultima sessione: <br>
			login:  $ultima_sessione[dataOra_login]<br>
			logout: $ultima_sessione[dataOra_logout]<br>
		";

		if($_SESSION['nuova_sessione']==true){
			//aggiungo la nuova sessione dell'utente
			$query4="insert into sessione (utente,dataOra_login,dataOra_logout) values ('$utente[username]',now(),now());"; 
			mysqli_query($conn,$query4) or die("errore ".mysqli_error($conn));
			$_SESSION['nuova_sessione']=false;
		}
		//controllo i permessi dell'utente
		$modifica_accesso=false;
		$modifica_permessi=false;
		$i=0;
		while($i<sizeof($operazioni)){   
			if($operazioni[$i]=="modifica_dati"){
				$modifica_accesso=true;
			}
			else if($operazioni[$i]=="modifica_regole"){
				$modifica_permessi=true;				
			$i++;
			}
		}
		if($modifica_dati==true){
			//form per la modifica dei dati dell'utente
			echo"<a href='modifica_dati.php'>Modificare i propri dati</a><br>";	
			
			echo"Modifica dati di accesso<form action='modifica_dati.php' method='POST'>
			<input type='hidden' name='vecchio_user' value='$utente[username]'>
			<input type='hidden' name='vecchia_pass' value='$utente[password]'>
			<table border='1'>
				<tr><td>Username</td><td><input type='text' name='user' value='$utente[username]'></td></tr>
				<tr><td>Password</td><td><input type='password' name='pass'></td></tr>
				<input type='hidden' name='vecchia_pass' value='$utente[password]'>
				<tr><td colspan='2'><input type='submit' name='ok' value='invia'></td></tr>
			</table>
			</form>";	
		}	
		if($modifica_permessi==true){
			//form per la modifica dei permessi
			echo"<a href='modifica_regole.php'>Editare nuove regole</a><br>";

			$query5="select * from operazioni";
			$risultato=mysqli_query($conn,$query5) or die("errore ".mysqli_error($conn));
			echo"Modifica permessi <br><table border='1'><tr><td>operazione</td><td>accesso</td><td>consentito</td></tr>";
			while($ris_query=mysqli_fetch_array($risultato)){
				echo"<form action='modifica_regole.php' method='POST'>";
			
				echo"<tr><td>$ris_query[tipo_operazione]</td><td>$ris_query[livello_accesso]</td>";
				if($ris_query['consentito']=='s'){
					echo"<td><input type='radio' name='consentito' value='s' checked> si 
					<input type='radio' name='consentito' value='n'> no </td>";
				}
				else{
					echo"<td><input type='radio' name='consentito' value='s' > si 
					<input type='radio' name='consentito' value='n' checked> no </td>";
				}
				echo"<input type='hidden' name='id' value='$ris_query[id_operazione]'>
				<td colspa='3'><input type='submit' name='ok' value='modifica'></td></tr>
			</form>";
			}
			echo"</table>";
		}
		echo"<a href='home.php'>Effettua Logout</a>";
	}
	else{
		echo" Devi prima loggarti <a href='home.php'> qui </a>";
	}
?>
