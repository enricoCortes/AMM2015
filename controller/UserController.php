

<?php
	switch($page){
		
		case "manageAccount":{
			
			list($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono) = $this->modelUser->getUserInfo($_SESSION['loggedUsername']);
			include "view/user/accountManagerView.php";
			break;
		}
		
		
		
		case "modifyPass":{
			$oldPass = $_REQUEST['oldpass'];
			$newPass = $_REQUEST['newpass'];
			$newPassConfirm = $_REQUEST['newpassconfirm'];
			
			$result = $this->modelUser->checkPass($_SESSION['loggedUsername'], $oldPass);
			if($result === false){
				$result = "wrong password";
				list($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $cap, $indirizzo, $telefono) = $this->modelUser->getUserInfo($_SESSION['loggedUsername']);	
				include "view/user/accountManagerView.php";
			}
			else{
				if($newPass === $newPassConfirm){
					$result = $this->modelUser->updatePass($_SESSION['loggedUsername'], $newPass);
					if($result === true) $result = "password modificata";		
					else $result = "password non modificata";
					list($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $cap, $indirizzo, $telefono) = $this->modelUser->getUserInfo($_SESSION['loggedUsername']);				
					include "view/user/accountManagerView.php";
				}		
				else{
					$result = "pass don't match";
					list($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $cap, $indirizzo, $telefono) = $this->modelUser->getUserInfo($_SESSION['loggedUsername']);				
				    include "view/user/accountManagerView.php";
				}		
			}
			break;
		}
		
		
		
		case "modifyInfoAccount":{
			
			$userToEdit     = 	$_SESSION['loggedUsername'];
			$newUsername    =	$_REQUEST['username'];
			$email			=	$_REQUEST['email'];
			$nome 			=	$_REQUEST['nome'];
			$cognome 		=	$_REQUEST['cognome'];
			$sesso 			=	$_REQUEST['sesso'];
			$citta			=	$_REQUEST['citta'];
			$provincia 		=	$_REQUEST['provincia'];
			$indirizzo		=	$_REQUEST['indirizzo'];
			$cap			=	$_REQUEST['cap'];
			$telefono		=	$_REQUEST['telefono'];
			
			$result = $this->modelUser->updateAccountInfo($userToEdit, $newUsername, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono);
			
			if($result === true) $result = "info account modificate";
			else $result = "info account non modificate";
				
			list($password, $email, $nome, $cognome, $sesso, $citta, $provincia, $indirizzo, $cap, $telefono) = $this->modelUser->getUserInfo($_SESSION['loggedUsername']);
	        include "view/user/accountManagerView.php";
			break;
		}
		
		case "nuovaInserzione":{
			include "view/user/nuovaInserzioneView.php";
			break;
		}
		
		case "imettiAnnuncio":{
			$titolo = $_REQUEST['titolo'];
			$descrizione = $_REQUEST['descrizione'];
			$prezzo = $_REQUEST['prezzo'];
			$marca = $_REQUEST['marca'];
			$modello = $_REQUEST['modello'];
			$colorazione = $_REQUEST['colore'];
			
			$result = $this->modelUser->imettiAnnuncio($titolo, $descrizione, $prezzo, $marca, $modello, $colorazione);
			
			if($result === false) include "view/user/nuovaInserzioneView.php";
			else if($result === true){
				$result = "annuncio registrato";
				include "view/user/userHomeView.php";
			}
			break;
		}
		
		case "confermaAcquisto":{
			$id = $_GET['id'];
			include "view/user/confermaAcquistoView.php";
			break;
		}
		
		case "processaAcquisto":{
			$id = $_GET['id'];
			$result = NULL;
			$result = $this->modelUser->processaAcquisto($id, $_SESSION['loggedUsername']);
			include "view/user/confermaAcquistoView.php";
			break;
		}
		
		
		case "mieInserzioni":{
			$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
			$user =	$_GET['username'];
			$items = $this->modelSession->getInserzioniByUsername($user);
			
			include "view/userInserzioniView.php";
			break;
		}
		
		case "chitarreAcquistate":{
			$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
			$user =	$_GET['username'];
			$items = $this->modelUser->getChitarreAcquistateByUsername($user);
			
			include "view/user/userChitarreAcquistateView.php";
			break;
		}
		
		case "chitarreVendute":{
			$row = NULL;  // conterrà i campi di ogni riga (una alla volta)
			$user =	$_GET['username'];
			$items = $this->modelUser->getChitarreVenduteByUsername($user);
			
			include "view/user/userChitarreVenduteView.php";
			break;
		}
	}



?>