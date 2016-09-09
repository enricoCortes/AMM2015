

<div id = "schermataLogin">
	
	<!-- se l'utente ha compilato il form di registrazione e la registrazione è andata a buon fine, gli mostro il messaggio di conferma -->
	<?php if( isset($result) ) 
			 if($result == "no errors in signin") 
				 echo "<p class = 'successMessage'> Registrazione effettuata con successo. Ora puoi accedere.</p> ";
			 else if($result == "login error")
					echo "<p class = 'errorMessage'> Impossibile accedere. Verificare che nome utente e password siano corretti e riprovare. </p> ";
	?>
	
	
	
	<h4> Effettua l'accesso </h4> <p class = "sgn"> &nbsp Non hai un account? <a href = "index.php?page=signin" class = "linkRegistrazione"> Registrati ora </a> </p>
	
	<form action = "index.php?page=login" method = "post">
		
		<table id = "loginTable">
			<tr>
				<td>Nome utente</td> <td><input type = "text" name = "username" required = "required" /> </td>
			</tr>	
			<tr>
				<td>Password</td> <td><input type = "password" name = "password" required = "required" /> </td>
			</tr>	
			<tr><td><input type = "submit" value = "Login" /></td></tr>
		</table>
		
	</form>
			
</div>