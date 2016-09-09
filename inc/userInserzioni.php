

<div id = "listaInserzioni">
	
	<?php if(isset($items) && $items === NULL) echo '<p class = "errorMessage">Non hai nessuno strumento in vendita </p>';?>
	
	<h3> Lista inserzioni di <?php echo $user ?></h3>
	
	<?php 
		$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
		if($items !== NULL){
			foreach($items as $items){
				foreach($items as $key => $value) $row[$key] = $value;	
				
				$id = $row[0];		       $marca = $row[1]; 
				$modello = $row[2];        $colorazione = $row[3];	
				$descrizione = $row[4];    $titolo_inserzione = $row[5]; 
				$prezzo = $row[6];         $data_inserzione = $row[7];
				$data_acquisto = $row[8];  $insertore = $row[9]; 
				$acquirente = $row[10];    $citta = $row[11];
	?>	

	<div class = "inserzione">
		<div class = "fotoArticolo">
			<img src = "img/image-not-found.jpg" alt = "Foto Chitarra/Guitar image not found">
		</div>

		<div class = "annuncio">
			<p class = "titoloInserzione"> <a href = "index.php?page=postDetails&id=<?php echo $id ?>"> <?php echo $titolo_inserzione ?> </a> </p>
			<p class = "descrizioneInserzione"> <?php echo $descrizione ?> </p>
		</div>

		<div class = "prezzo">
			<p class = "prezzo"> <?php echo $prezzo ?>€ </p>
		</div>

		<div class = "utente">
			<p class = "dataInserzione"> <?php echo $data_inserzione ?> </p>
		</div>
	</div>	
	<br/><hr/>	




	<?php
			}
		}	 
	?>
	
	

	
</div>