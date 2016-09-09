<?php

	class ModelUser{
		
		//restituisce true se la password passata coincidecon quella dell'utente
		function checkPass($utente, $password_to_check){
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "select password
					  from utente
					  where username = '$utente' 
					  AND password = '$password_to_check'; ";	
			
			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query($query);
			
			//se ci sono errori nella query
			if($dbhandler === false) return false;
			
			$row = $dbhandler->fetch_object( );
			
			if($row->password == $password_to_check) return true;
			else return false;
		}
		
		
		// restituisce un array contenente le informazioni sull'utente
		function getUserInfo($username){
			
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "Select * from utente where username='$username' ";		

			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query($query);
			
			//se ci sono errori nella query
			if($dbhandler === false){
				$result = "query error";
				return false;
			}
			
			
			$row = $dbhandler->fetch_object( );
			
			$password    =  $row->password; 
			$email 	     =  $row->email; 
			$nome        =  $row->nome; 
			$cognome     =  $row->cognome; 
			$sesso 	     =  $row->sesso; 
			$citta 	     =  $row->citta; 
			$provincia   =  $row->provincia; 
			$indirizzo   =  $row->indirizzo; 
			$cap 		 =  $row->cap; 
			$telefono 	 =  $row->telefono; 
											
			return array($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono);
		} // Fine getUserInfo
		
		
		// cambia la password dell' utente passato come argomento con la nuova password passata come argomento
		function updatePass($username, $newPass){
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "UPDATE utente 
				      SET password = '$newPass' 
					  WHERE utente.username = '$username';";	
			
			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query($query);
			
			//se ci sono errori nella query
			if($dbhandler === false) return false;
			
			else return true;
		}// fine updatePass
		
		
		
		// aggiorna le informazioni dell'utente
		function updateAccountInfo($userToEdit, $newUsername, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono){
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "UPDATE utente 
				      SET username   = '$newUsername',
						  email      = '$email',
						  nome		 = '$nome',
						  cognome	 = '$cognome',
						  sesso		 = '$sesso',
						  citta		 = '$citta',
						  provincia	 = '$provincia',
						  indirizzo	 = '$indirizzo',
						  cap		 = '$cap',
						  telefono	 = '$telefono'
					 WHERE utente.username = '$userToEdit'; ";
			
			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query($query);
			
			//se ci sono errori nella query
			if($dbhandler === false) return false;
		
			else{
				$_SESSION['loggedUsername'] = $newUsername; // aggiorno la variabile di sessione con i nuovo nome utente
				return true;
			}
		}// fine updateAccountInfo
		
		
		// esegue l'acqusto della chitarra
		function processaAcquisto($id, $username){
			$database_functions = new databaseUtility( );
			$data_ora = date("Y-m-d H:i:s"); //restituisce la data e l'ora attuale nel formattata in modo da non dareproblem con mysql
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "UPDATE inserzione 
				      SET data_acquisto = '$data_ora',
						  acquirente = '$username'
					  WHERE id = '$id'; ";
			
			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query_con_transazione($query);
			
			//se ci sono errori nella query
			if($dbhandler === false) return false;
			else return true;	
		}// fine processaAcquisto
		
		
		function imettiAnnuncio($titolo, $descrizione, $prezzo, $marca, $modello, $colorazione){
			$database_functions = new databaseUtility( );
			$data_ora = date("Y-m-d H:i:s"); //restituisce la data e l'ora attuale nel formattata in modo da non dareproblem con mysql
			$user = $_SESSION['loggedUsername'];
			
			$dbhandler = $database_functions->connetti_al_database( );
			
			if($dbhandler === false){ // se non riesco a connettermi al db
					$result = "errore connessione db";
					return false; 
			}
			
			$query = "INSERT into inserzione 
				      VALUES (NULL, '$marca', '$modello', '$colorazione', '$titolo', '$descrizione', '$prezzo', '$data_ora', NULL, '$user', NULL) ";
			
			// eseguo la query e salavo il risultato 
			$dbhandler = $database_functions->esegui_query_con_transazione($query);
			
			//se ci sono errori nella query
			if($dbhandler === false) return false;
			else return true;	
		}// fine imettiAnnuncio
		
		
		function getChitarreAcquistateByUsername($username){
			$database_functions = new databaseUtility( );
			$items = NULL;
			$i = 0;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false || $dbhandler === NULL) return NULL; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select inserzione.*
						  from inserzione
						  where acquirente = '$username';  
						 "; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return NULL;
				else{
					while($row = $dbhandler->fetch_object( ) ){
						$id = ($row->id);		             	 $marca = ($row->marca); 
						$modello = ($row->modello);              $colorazione = ($row->colorazione);	
						$descrizione = ($row->descrizione);      $titolo_inserzione = ($row->titolo_inserzione); 
						$prezzo = ($row->prezzo);                $data_inserzione = ($row->data_inserzione);
						$data_acquisto = ($row->data_acquisto);  $insertore = ($row->insertore);
						$acquirente = ($row->acquirente);
						
						$items[$i] = array($id, $marca, $modello, $colorazione, $descrizione, $titolo_inserzione, $prezzo, $data_inserzione, $data_acquisto, $insertore, $acquirente);
					    $i++;
					}
					return $items;
				}
			}	
		}// fine getChitarreAcquistateByUsername
		
		
		function getChitarreVenduteByUsername($username){
			$database_functions = new databaseUtility( );
			$items = NULL;
			$i = 0;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false || $dbhandler === NULL) return NULL; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select inserzione.*
						  from inserzione
						  where insertore = '$username' AND acquirente IS NOT NULL;  
						 "; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return NULL;
				else{
					while($row = $dbhandler->fetch_object( ) ){
						$id = ($row->id);		             	 $marca = ($row->marca); 
						$modello = ($row->modello);              $colorazione = ($row->colorazione);	
						$descrizione = ($row->descrizione);      $titolo_inserzione = ($row->titolo_inserzione); 
						$prezzo = ($row->prezzo);                $data_inserzione = ($row->data_inserzione);
						$data_acquisto = ($row->data_acquisto);  $insertore = ($row->insertore);
						$acquirente = ($row->acquirente);
						
						$items[$i] = array($id, $marca, $modello, $colorazione, $descrizione, $titolo_inserzione, $prezzo, $data_inserzione, $data_acquisto, $insertore, $acquirente);
					    $i++;
					}
					return $items;
				}
			}	
		}// fine getChitarreVenduteByUsername
	}//fine ModelUser
?>
