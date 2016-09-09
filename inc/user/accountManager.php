
<div id = "myAccount">
	
	<h3> My Account </h3>
	
	<?php 
		if(isset($result)){ 
			if($result == "password modificata") echo "<p class = 'successMessage'>La password è stata modificata con successo</p>";
			else if($result == "password non modificata") echo "<p class = 'errorMessage'>Errore. La password non è stata modificata per problemi con il server.</p>";
				 else if($result == "pass don't match") echo "<p class = 'errorMessage'>La conferma della password non coincide</p>";
					  else if($result == "wrong password") echo "<p class = 'errorMessage'>La password immessa non è corretta</p>";
		}
	?>
	<?php 
		if(isset($result)){ 
			if($result == "info account modificate") echo "<p class = 'successMessage'>Le informazioni sono state modificate con successo. </p>";
			else if($result == "info account non modificate") echo "<p class = 'errorMessage'>Impossibile modificare le informazioni. Riprova in seguito. </p>";
		}
	?>
	
	<p class = "linkMieInserzioni"> <a href = "index.php?page=mieInserzioni&username=<?php echo $_SESSION['loggedUsername']?>">Le mie inserzioni di vendita </a> </p> <br/>
	<p class = "linkMieInserzioni"> <a href = "index.php?page=chitarreAcquistate&username=<?php echo $_SESSION['loggedUsername']?>">Chitarre acquistate </a> </p> <br/>
	<p class = "linkMieInserzioni"> <a href = "index.php?page=chitarreVendute&username=<?php echo $_SESSION['loggedUsername']?>">Chitarre vendute </a> </p> 
	
	<form action = "index.php?page=modifyInfoAccount" method = "post">
		<table>
			<caption> <h5>Informazioni personali</h5> </caption>
			<tr>	
				<td class = "etichetta">Username</td> <td><input type = "text"  name = "username"  required = "required" autocomplete = "off" value = "<?php echo $_SESSION['loggedUsername'] ?>"></td>    
			</tr>
			
			<tr>	
				 <td class = "etichetta">Email</td> <td><input type = "text"  name = "email"  required = "required" autocomplete = "off" value = "<?php echo "$email" ?>"></td> 
			</tr>
			
			<tr>	
				<td class = "etichetta"> Nome</td> <td><input type = "text"  name = "nome"  required = "required" autocomplete = "off" value = "<?php echo "$nome" ?>"></td>    
			</tr>
			
			<tr>	
				<td class = "etichetta" >Cognome</td> <td><input type = "text"  name = "cognome"  required = "required" autocomplete = "off" value = "<?php echo "$cognome" ?>"></td>    
			<tr/>
			
			<tr>
				<td class = "etichetta">Sesso</td>
				<td><input type="radio" name="sesso" value="M" <?php if($sesso == 'M') echo "checked"?>> M &nbsp; &nbsp; &nbsp;
					<input type="radio" name="sesso" value="F" <?php if($sesso == 'F') echo "checked"?>> F 
				</td>					 	
			</tr>
			
			<tr>	
				<td class = "etichetta">Citta'</td> <td><input type = "text"  name = "citta"  required = "required" autocomplete = "off" value = "<?php echo "$citta" ?>"> </td>   &nbsp; &nbsp;  
			    <td class = "etichetta">Provincia</td> <td><input type = "text"  name = "provincia"  required = "required" autocomplete = "off" value = "<?php echo "$provincia" ?>"></td>    
			<tr/>
			
			<tr>	
				 <td class = "etichetta">Indirizzo</td> <td><input type = "text"  name = "indirizzo"  required = "required" autocomplete = "off" value = "<?php echo "$indirizzo" ?>"></td>    &nbsp; &nbsp; 
				 <td class = "etichetta"> CAP </td> <td> <input type = "text"  name = "cap"  required = "required" autocomplete = "off" value = "<?php echo "$cap" ?>"> </td>   
			<tr/>
			
			<tr>	
				<td class = "etichetta" >Telefono</td> <td><input type = "text"  name = "telefono" autocomplete = "off" value = "<?php echo "$telefono" ?>"></td>     
			<tr/>
			
			<tr><td> <input type = "submit" value = "Esegui modifica" /> </td> </tr>
		</table>
	</form>
	
	<br/>
	
	
	
	<form action = "index.php?page=modifyPass" method = "post">
		<table> 
			<caption> <h5>Modifica password</h5> </caption>
			<tr><td> <input type = "password" name = "oldpass" required = "required" value = ""/> </td>  <td class = "etichetta">Vecchia Password </td> </tr>
			<tr><td> <input type = "password" name = "newpass" required = "required"/> </td>  <td class = "etichetta">Nuova Password </td> </tr>
			<tr><td> <input type = "password" name = "newpassconfirm" required = "required"/>  </td><td class = "etichetta">Conferma nuova Password </td></tr>	
			<tr><td> <input type = "submit" value = "Esegui modifica" /> </td> </tr>
		</table>
	</form>
	
	<br/>
	
</div>
