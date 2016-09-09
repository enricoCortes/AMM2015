<?php

/*Model dell'amministratore, racchiude tutte le funzioni che possono essere eseguite dall'amministratore, quali : Aggiunta o eliminazione carta, Visualizzazione lista delle carte del negozio e degli ordini effettuati*/

	class ModelAmm{
		
		
		function getUserByUsername($username){
			$database_functions = new databaseUtility( );
			$item = NULL;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) return NULL; // se non riesco a connettermi restituisco false	
			else{
				$query = "select *
						  from utente
						  where username = '$username';"; ; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return NULL;
				else{
					$item = $dbhandler->fetch_object( ); 
				
					$email= ($item->email);		 	   $nome = ($item->nome); 
					$cognome= ($item->cognome);  	   $sesso = ($item->sesso);	
					$citta = ($item->citta);           $provincia = ($item->provincia); 
					$indirizzo = ($item->indirizzo);   $cap = ($item->cap); 
					$telefono = ($item->telefono);
					
					return array($username, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono);
				}
			}
		} // fine getUserByUsername
		
		
		function getUsersInfo( ){
			$database_functions = new databaseUtility( );
			$items = NULL;
			$i = 0;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false || $dbhandler === NULL) return false; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select username, email, nome, cognome, sesso, citta, provincia, indirizzo, cap, telefono
						  from utente
						  where privilegi = 'U';"; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return false;
				else{
					while($row = $dbhandler->fetch_object( ) ){
						$email= ($row->email);		 	   $nome = ($row->nome); 
						$cognome= ($row->cognome);  	   $sesso = ($row->sesso);	
						$citta = ($row->citta);            $provincia = ($row->provincia); 
						$indirizzo = ($row->indirizzo);    $cap = ($row->cap); 
						$telefono = ($row->telefono);	   $username= ($row->username);
							
						$items[$i] = array($username, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono);
					    $i++;
					}
					return $items;
				}
			}
		}// fine getUsers
		
		
		function getUserCount( ){
			$database_functions = new databaseUtility( );
			$item = NULL;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) return NULL; // se non riesco a connettermi restituisco false	
			else{
				$query = "select count(*) as numeroUtenti
						  from utente
						  where privilegi = 'U';"; ; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return NULL;
				else{
					$item = $dbhandler->fetch_object( ); 
				
					$numeroUtenti = ($item->numeroUtenti);
					
					return $numeroUtenti;
				}
			}
		}
		
		function dropUser($username){
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) return false; // se non riesco a connettermi restituisco false	
			else{
				$query = "DELETE 
						  FROM utente 
						  WHERE username = '$username'; "; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return false;
				else return true;						
			}	
		}// fine dropUser
		
		
	}//fine modelAmm

?>
