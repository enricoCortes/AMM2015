
<div id = "nuovaInserzione">
	<?php if(isset($result) && $result == false) echo '<p class = "errorMessage">Non è stato possibile inserire l\'annuncio. Controlla che i campi siano corretti </p>';?>
	
	<h3> Nuova Inserzione </h3>
	
	<form action = "index.php?page=imettiAnnuncio" method = "post">
		<div class = "titolo">
			<p class = "titolo">Inserisci il nome dell'annuncio </p>
			<textarea name = "titolo" cols = "120" rows = "2" required = "required">Titolo </textarea>
		</div>
		
		
		<div class = "prezzo">
			<p class = "titolo">Prezzo</p>
			<input type = "text" name = "prezzo" size = "6" required = "required"/> <b> € </b>
		</div>
		
		<div class = "extraInfo">
			<div class = "marca">
				<p class = "titolo">Marca</p>
				<input type = "text" name = "marca" size = "20" required = "required"/>
			</div>
			
			<div class = "modello">
				<p class = "titolo">Modello</p>
				<input type = "text" name = "modello" size = "20" required = "required"/>
			</div>
			
			<div class = "colorzione">
				<p class = "titolo">Colorazione</p>
				<input type = "text" name = "colore" size = "20" required = "required"/>
			</div>
		</div>
		
		<div class = "descrizione">
			<p class = "titolo">Descrivi il prodotto e inserisci le informazioni che ritieni utili </p>
			<textarea name = "descrizione" cols = "120" rows = "15" required = "required"> Inserisci la descrizione </textarea>
		</div>
		
		<div class = "conferma">
			<input type = "submit" value = "Conferma"/>
		</div>
		
	</form>
	
	
</div> 
