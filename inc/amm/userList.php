<div id = "ammContent">

	<?php 
		if(isset($resultDrop) && $resultDrop === true) echo '<p class = "successMessage">L\'utente <b>' . $user . '</b> è stato eliminato. </p>';
		else if(isset($resultDrop) && $resultDrop === false) echo '<p class = "errorMessage">L\'utente <b>' . $user . '</b> NON è stato eliminato forevah. </p>';
	?>
	
	<h4> Lista Utenti </h4>
	
	<?php if(isset($userCount) && $userCount === NULL) echo '<p class = "errorMessage"> Impossibile contattare il database. </p>'; 
		  else if(isset($users) && $users === NULL) echo '<p class = "errorMessage"> Non ci sono utenti registrati. </p>'; 
			   else if (isset($users) && $users === false) echo  '<p class = "errorMessage"> Impossibile contattare il database. </p>'; 
			   else if(isset($users) && isset($userCount)){
				    echo '<p class = "successMessage">Sono presenti <b>' . $userCount . '</b> utenti </p>';
			
						$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
						foreach($users as $users){
							foreach($users as $key => $value) $row[$key] = $value;	
							 
							$username= $row[0];   $email= $row[1];        $nome = $row[2]; 
							$cognome= $row[3];    $sesso = $row[4];       $citta = $row[5];         
							$provincia = $row[6]; $indirizzo = $row[7];   $cap = $row[8];
							$telefono = $row[9];;   
	?>
	
	
	<div class = "userSquare"> 
		<p class = "nomeUtente"> <?php echo $username; ?> </h5>
		<p class = "genericInfo"> <?php echo $sesso; ?> </p>
		<p class = "genericInfo"> <?php echo $email; ?> </p>
		<p class = "genericInfo"> <?php echo "$nome"." $cognome"; ?> </p>
		<p class = "genericInfo"> <?php echo "$citta"." ($provincia)";?> </p>
		<p class = "genericInfo"> <?php echo "$indirizzo"." &nbsp;&nbsp;CAP:$cap" ?> </p>
		<p class = "genericInfo"> <?php echo $email; ?></p>
		<p><a class = "dropUser" href = "index.php?page=dropUser&user=<?php echo $username?>"> Elimina utente </a></p>
	</div>
	
				<?php }}?>
	
	
	
	<!--
	<div class = "userSquare"> 
		<p class = "nomeUtente"> Nome utente </h5>
		<p class = "genericInfo"> Sesso: M/F</p>
		<p class = "genericInfo"> Email Email Email</p>
		<p class = "genericInfo"> Nome Cognome</p>
		<p class = "genericInfo"> Citta (PR)</p>
		<p class = "genericInfo"> Via Via Via 09010</p>
		<p class = "genericInfo"> Telefono</p>
	</div>
	
	-->
	

</div>
