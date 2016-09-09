


<div id = "listaInserzioni">
	
	<?php if($items == NULL) echo '<p class = "errorMessage">Non hai venduto nessuno strumento </p>';
		  else echo " <h3> Lista chitarre vendute di $user </h3> ";
	?>
	<hr/><br/>
	
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
				$acquirente = $row[10]; 
	?>	

	<div class = "inserzione">
		<div class = "fotoArticolo">
			<img src = "img/image-not-found.jpg" alt = "Foto Chitarra/Guitar image not found">
		</div>

		<div class = "annuncio">
			<p class = "titoloInserzione"> <a href = "index.php?page=postDetails&id=<?php echo $id ?>"> <?php echo $titolo_inserzione ?> </a> </p>
		</div>

		<div class = "prezzo">
			<p class = "prezzo"> <?php echo $prezzo ?>€ </p>
		</div>

		<div class = "utente">
			<p class = "nomeUtente"> Acquirente: <?php echo $acquirente ?> </p>
			<p class = "dataInserzione"> Data inserzione: <?php echo $data_inserzione ?> </p>
			<p class = "dataInserzione"> Daa acquisto: <?php echo $data_acquisto ?> </p>
		</div>
	</div>	
	<br/><hr/>	




	<?php
			}
		}	 
	?>
	

	
</div>