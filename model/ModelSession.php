<?php
	
	// mi permette di connettermi, disconnettermi ed eseguire query senza riscrivere le stesse cose ogni volta
	class databaseUtility{
		private $db_host = 'localhost';
		private $db_user = 'cortesEnrico';
		private $db_password = 'pecora6558';
		private $db_name = 'amm15_cortesEnrico ';
		private $mysqli = NULL;
		public $idError = NULL;
		public $msg = NULL;
		public $query_output = NULL;
		
		public function connetti_al_database( ){
			$this->mysqli = new mysqli();
			$this->mysqli->connect($this->db_host, $this->db_user, $this->db_password, $this->db_name); //connessione al db
		
			if($this->mysqli->connect_errno != 0){ // se non riesco a contattare il DB
				$this->idError = $this->mysqli->connect_errno; //salvo l'id dell'errore
				$this->msg = $this->mysqli->connect_error; //salvo il messaggio dell'errore
				return false; // se non mi sono coneesso restituisco false
			}
			else return true; // se mi sono connesso restituisco true
		}
		
		public function disconnetti_database( ){
			$this->mysqli = $this->mysqli->close();
			return true;
		}
		
		public function esegui_query($query){
			$this->query_output = $this->mysqli->query($query);
			if($this->query_output === NULL){
				$this->mysqli = $this->disconnetti_database( );
				return NULL;
			} 
			if($this->mysqli->errno > 0){
				//non mi serve più lavorare sul db, quindi chiudo la connessione con esso
				$this->mysqli = $this->disconnetti_database( );
				return false;
			}
			else return $this->query_output;
		}
		
		public function esegui_query_con_transazione($query){
			$this->mysqli->autocommit(false); //il commit non viene fatto in automatico
			$this->mysqli->begin_transaction(); // inizio la transazione
			
			$this->query_output = $this->mysqli->query($query);
			
			//se la queryrichiesta non va a buon fine
			if($this->query_output === NULL){
				$this->mysqli = $this->disconnetti_database( );
				return NULL;
			} 
			if($this->mysqli->errno > 0){
				$this->mysqli->rollback(); //riporto il db allo stato precedente rispetto alla begin_transaction
				//non mi serve più lavorare sul db, quindi chiudo la connessione con esso
				$this->mysqli = $this->disconnetti_database( );
				return false;
			}
			else{
				//le query sono andate a buon fine
				$this->mysqli->commit(); //rendo permanenti le modifiche apportate dalle query al db

				$this->mysqli->autocommit(true); //reimposto l'autocommit
				return $this->query_output;
			}
		}
	}

	

	class ModelSession{ 

		//Funzione per il login
		public function getLogin($username, $pass){
						
			$privilegi = null; //la utilizzero per salvare il ruolo dell'utente che logga
			$user = null; //la utilizzero per salvare l'username dell'utente che logga
			$password = null;
			$database_functions = new databaseUtility( ); // funzioni per evitare di ripetere i comandi principali per il DB
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) // se non riesco a connettermi al db
				return false; //restituisco messaggio errore
			
			else{ //connessione effettuata con successo. Posso lavorare sul database

				//scrivo la query
				$query = "Select * from utente where password='$pass' AND username='$username' ";		
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				

				//se ci sono errori nella query
				if($dbhandler === false) return false;
				
				else{
					while($row = $dbhandler->fetch_object( ) ){
						$user = ($row->username); //salvo l'username
						$password = ($row->password); //salvo la password
						$privilegi = ($row->privilegi); //salvo i privilegi
					}
					
					if($password !== $pass) return false; // se le password non coincidono, non faccio loggare
					
					//A seconda dei valori di $privilegi, so se ha effettuato il login un utente o l'amministratore
					if($privilegi == "A"){		
						$_SESSION["loggedAmm"] = true; //amministratore loggato
						$_SESSION["loggedUsername"] = $user; //username dell'amministratore loggato
						$_SESSION["loggedUser"] = false;
						return true;			
					 
					}else{
						if($privilegi == "U"){		
							$_SESSION["loggedAmm"] = false;
							$_SESSION["loggedUsername"] = $user; //username dell'utente loggato
							$_SESSION["loggedUser"] = true;
							return true;						
						
						}else{
							$_SESSION["loggedUser"] = false;
							$_SESSION["loggedAmm"] = false;				
							return false; //errore nel login
						}					
					}
				}
				
			}
		}

		
		
		//Funzione per la registrazione dell'utente
		public function getSignin($username, $password, $email, $nome, $cognome, $sesso, $citta, $provincia, $cap, $indirizzo, $telefono){
			
			$database_functions = new databaseUtility( );
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) return false; // se non riesco a connettermi restituisco false	
			else{
				$query = "INSERT INTO utente (`username`, `password`, `email`, `nome`, `cognome`, `sesso`, `citta`, `provincia`, `indirizzo`, `cap`, `telefono`, `privilegi`)
									  VALUES ('$username', '$password', '$email', '$nome', '$cognome', '$sesso', '$citta', '$provincia', '$indirizzo', '$cap', '$telefono', 'U');";		

				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return false;
				else return true;
			}
		}
		
		
		
		/*Funzione per la gestione del logout*/
		public function getLogout( ){

			$_SESSION = array(); //reset array $_SESSION

			//terminazione della validità del cookie
			if(session_id() != "" || isset($_COOKIE[session_name()])){ 
				
				//imposta il termine della validità del cookie al mese scorso
				setcookie(session_name(), '', time() - 2592000, '/');			

			}		
			//distruzione del file di sessione	
			session_destroy();

			return "logout";
		}
	
		
		
		public function getPostDetails($id){
			$database_functions = new databaseUtility( );
			$item = NULL;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false) return NULL; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select inserzione.*, utente.citta 
						  from inserzione JOIN utente on utente.username = inserzione.insertore
						  where inserzione.id = '$id';"; ; 
				
				// eseguo la query e salavo il risultato 
				$dbhandler = $database_functions->esegui_query($query);
				if($dbhandler === false) return NULL;
				else{
					$item = $dbhandler->fetch_object( ); 
				
					$id = ($item->id);		             	  $marca = ($item->marca); 
					$modello = ($item->modello);              $colorazione = ($item->colorazione);	
					$descrizione = ($item->descrizione);      $titolo_inserzione = ($item->titolo_inserzione); 
					$prezzo = ($item->prezzo);                $data_inserzione = ($item->data_inserzione);
					$data_acquisto = ($item->data_acquisto);  $insertore = ($item->insertore); 
					$acquirente = ($item->acquirente);		  $citta = ($item->citta);
					
					return array($id, $marca, $modello, $colorazione, $descrizione, $titolo_inserzione, $prezzo, $data_inserzione, $data_acquisto, $insertore, $acquirente, $citta);
				}
			}
		}
		
		/*Restituisce la lista delle inserzioni */
		function getProductList( ){
			$database_functions = new databaseUtility( );
			$items = NULL;
			$i = 0;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false || $dbhandler === NULL) return NULL; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select inserzione.*, utente.citta 
						  from inserzione JOIN utente on utente.username = inserzione.insertore
						  where inserzione.acquirente IS NULL
						  ORDER BY data_inserzione DESC;"; 
				
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
						$acquirente = ($row->acquirente);		 $citta = ($row->citta);
						
						$items[$i] = array($id, $marca, $modello, $colorazione, $descrizione, $titolo_inserzione, $prezzo, $data_inserzione, $data_acquisto, $insertore, $acquirente, $citta);
					    $i++;
					}
					return $items;
				}
			}
		}// fine getProductList
		
	
		function getInserzioniByUsername($username){
			$database_functions = new databaseUtility( );
			$items = NULL;
			$i = 0;
			
			$dbhandler = $database_functions->connetti_al_database( );

			if($dbhandler === false || $dbhandler === NULL) return NULL; // se non riesco a connettermi restituisco false	
			else{
				 //seleziono tutti i prodotti che non sono ancora stati acquistati
				$query = "select inserzione.*, utente.citta 
						  from inserzione JOIN utente on utente.username = inserzione.insertore
						  where utente.username='$username';"; 
				
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
						$acquirente = ($row->acquirente);		 $citta = ($row->citta);
						
						$items[$i] = array($id, $marca, $modello, $colorazione, $descrizione, $titolo_inserzione, $prezzo, $data_inserzione, $data_acquisto, $insertore, $acquirente, $citta);
					    $i++;
					}
					return $items;
				}
			}	
		}// fine getInserzioniByUsername
		
		
		function eseguiAcquisto($id, $username){
			
			return true;
		}
		// fine eseguiAcquisto
		
		
	}
	
	
	
?>
