
<div id = "confermaAcquisto">

	<?php if(!isset($result) || $result === NULL){   ?>
			  <h4> Sei sicuro di voler acquistare ????? </h4>

			  <p> <a href = "index.php?page=processaAcquisto&id=<?php echo $id?>"> Conferma </a> </p>
			  <p> <a href = "index.php?page=productList"> Annulla </a> </p>
	<?php }
		  else
			  if(isset($result) && $result === true) echo '<br/><br/><p class = "successMessage">Acquisto effettuato con successo. Puoi continuare la navigazione </p>';
			  else if(isset($result) && $result === false) echo '<br/><br/><p class = "errorMessage">Impossibile effettuare l\'acquisto. Prova tra qualche minuto.</p>';
	?>
				
	
</div>