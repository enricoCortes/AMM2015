
<div id = "postDetails">
	
	<?php
		$item = $this->modelSession->getPostDetails($_GET['id']);
		
		if($item === NULL) echo "<p class = \"errorMessage\">L'inserzione non esiste </p> ";
		else{
			$id = $item[0];		        $marca = $item[1]; 
			$modello = $item[2];        $colorazione = $item[3];	
			$descrizione = $item[4];    $titolo_inserzione = $item[5]; 
			$prezzo = $item[6];         $data_inserzione = $item[7];
			$data_acquisto = $item[8];  $insertore = $item[9]; 
			$acquirente = $item[10];    $citta = $item[11];
		}
	?>
	
	<div class = "titoloInserzione">	
		<h2> <?php echo $titolo_inserzione?>  </h4>
	</div>
	
	<div class = "fotoArticolo">
		<img src = "img/image-not-found.jpg" alt = "Foto Chitarra/Guitar image not found">
	</div>
	
	<div class = "rightOfImage">
		
		<div class = "prezzo">
			<p> <?php echo "$prezzo" . "€"; ?> </p>
		</div>
		
		<div class = "utenteZonaData">
			<p class = "inesrtore"> <?php echo $insertore ?> </p>
			<p class = "citta"> <?php echo $citta ?> </p>
			<p class = "data"> <?php echo $data_inserzione ?> </p>
		</div>
		
		<div class = "buyButton">
			<!-- se sono un utente e non ho messo in vendita io la chitarra, posso acquistare -->
			<?php if($_SESSION["loggedUser"] === true && strtolower($insertore) !==  strtolower($_SESSION["loggedUsername"]) && $data_acquisto === NULL){ ?>
						<form action = "index.php?page=confermaAcquisto&id=<?php echo $id?>"  method = "post">
							<input type = "submit" value = "ACQUISTA" class = "acq"/> 
						</form>
			<!-- altrimenti se sono un amministratore oppure sono l'utente che ha messo in vendita lo strumento, non posso acquistare -->
			<?php }	  
				  else{ 
			?>
					  <input type = "submit" value = "CAN'T BUY" class = "nonacq"/> 
				  <?php } ?>
		</div>
		
	</div>
	
	<div class = "descrizioneInserzione">
		<p> <?php echo $descrizione ?> </p>
	</div>
</div>