
<div id = "listaInserzioni">
	
	<?php if(isset($result) && $result === "annuncio registrato"){
			echo '<p class = "successMessage"> Il tuo annuncio è stato registrato e reso visibile algi altri utenti </p>';
			unset($result);
	}
	?>
	
	<h3> Chitarre in vendita </h3>
	
	<?php 
		$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
		
		$items = $this->modelSession->getProductList( );
		if($items === NULL) echo '<p class = "errorMessage"> Non ci sono inserzioni </p>';
		else{
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
		<br/><hr/>	
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
			<p class = "nomeUtente"> <?php echo $insertore ?> </p>
			<p class = "zona"> <?php echo $citta ?> </p>
			<p class = "dataInserzione"> <?php echo $data_inserzione ?> </p>
		</div>
	</div>	
		
	<?php
		}// chiusura else
			} // chiusura foreach
	?>
	
	
	
	<!--
	
	<div class = "inserzione">
		<div class = "fotoArticolo">
			<img src = "img/guitar-img-not-found.png" alt = "Guitar image not found">
		</div>
		
		<div class = "annuncio">
			<p class = "titoloInserzione"> Titolo inserzione </p>
			<p class = "descrizioneInserzione"> Descrizione short </p>
		</div>
		
		<div class = "prezzo">
			<p class = "prezzo"> Prezzo </p>
		</div>
		
		<div class = "utente">
			<p> Nome Utente </p>
			<p> Zona </p>
			<p> Data </p>
		</div>
	</div>	
		
		
		
	<div class = "inserzione">	
		<div class = "fotoArticolo">
			<img src = "img/guitar-img-not-found.png" alt = "Guitar image not found">
		</div>
		
		<div class = "annuncio">
			<p class = "titoloInserzione"> Titolo inserzione </p>
			<p class = "descrizioneInserzione"> Descrizione short </p>
		</div>
		
		<div class = "prezzo">
			<p class = "prezzo"> Prezzo </p>
		</div>
		
		<div class = "utente">
			<p> Nome Utente </p>
			<p> Zona </p>
			<p> Data </p>
		</div>
	</div>
	-->
</div>