

<div id = "schermataSignin">

	<?php if( isset($result) ){ 
			if($result == "password unmatched") echo "<p class = 'errorMessage'> Le password non coincidono, ridigitare.</p>";
			if($result == "errors in signin") echo "<p class = 'errorMessage'> C'è stato quelche errore e non è stato possibile effettuare la registrazione<br/>
													Probabilmente l'username è stato preso da un altro utente.</p>";
		  }
	?>
	
	
	<h4> Inserisci i dati richiesti </h4>
	
	<form action = "index.php?page=dosignin" method = "post">
		<table id = "signinTable">
			<tr>
				<td class = "etichetta">Nome utente</td>   <td><input type = "text"  name = "username"  required = "required" autocomplete = "off" value="" maxlenght="20"> </td>
			</tr>
			
			<tr>	
				<td class = "etichetta">Password</td>   <td><input type = "password"  name = "password"  required = "required" autocomplete = "off" value=""> </td>
			</tr>
			
			<tr>	
				<td class = "etichetta">Conferma password</td>   <td><input type = "password"  name = "passwordConfirm"  required = "required" autocomplete = "off" value=""> </td>
			</tr>
			
			<tr>	
				<td class = "etichetta">Email</td>   <td><input type = "text"  name = "email"  required = "required" autocomplete = "off"> </td>
			</tr>
			
			<tr>	
				<td class = "etichetta">Nome</td>   <td><input type = "text"  name = "nome"  required = "required" autocomplete = "off"> </td>
			</tr>
			
			<tr>	
				<td class = "etichetta">Cognome</td>   <td><input type = "text"  name = "cognome"  required = "required" autocomplete = "off"> </td>
			<tr/>
			
			<tr>
				<td class = "etichetta">Sesso</td>   <td><input type="radio" name="sesso" value="M" checked> M &nbsp; &nbsp; &nbsp;
														 <input type="radio" name="sesso" value="F"> F </td>					 
			</tr>
			
			<tr>	
				<td class = "etichetta">Citta'</td>   <td><input type = "text"  name = "citta"  required = "required" autocomplete = "off"> &nbsp; &nbsp; </td> 
				<td class = "etichetta">Provincia</td>   <td><input type = "text"  name = "provincia"  required = "required" autocomplete = "off">   </td>  
			<tr/>
			
			<tr>	
				<td class = "etichetta">Indirizzo</td>   <td><input type = "text"  name = "indirizzo"  required = "required" autocomplete = "off"> &nbsp; &nbsp;</td>
				<td class = "etichetta"> CAP </td> <td> <input type = "text"  name = "cap"  required = "required" autocomplete = "off"> </td>
			<tr/>
			
			<tr>	
				<td class = "etichetta">Telefono</td>   <td><input type = "text"  name = "telefono" autocomplete = "off"> </td>
			<tr/>
			
			<tr><td><input type = "submit" value = "Registrati" /></td></tr>
		</table>
	</form>
	

</div>