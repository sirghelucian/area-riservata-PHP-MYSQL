<?php
	include("config.php");
	session_start();
	$query5="select * from operazioni";
			$risultato=mysqli_query($conn,$query5) or die("errore ".mysqli_error($conn));
			echo"Modifica permessi <br><table border='1'><tr><td>operazione</td><td>accesso</td><td>consentito</td></tr>";
			while($ris_query=mysqli_fetch_array($risultato)){
			
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
	if(isset($_POST['ok'])){
		$query="update operazioni set consentito='$_POST[consentito]' where id_operazione=$_POST[id]";
		mysqli_query($conn,$query) or die("errore ".mysqli_query($conn));
		echo "regola aggiornata correttamente<br><a href='pagina.php'>indietro</a>";
	}
?>