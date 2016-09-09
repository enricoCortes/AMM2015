<?php

	/*Controller*/

	include_once("model/ModelSession.php"); //includo il codice del ModelSession contenente le funzioni per la gestione del login
	include_once("model/ModelAmm.php"); //includo il codice del ModelAmm per la gestione delle funzioni dell'amministratore
	include_once("model/ModelUser.php"); //includo il codice del ModelUser per la gestione delle funzioni dell'utente
	
	class Controller{

		//variabili istanza

		public $modelSession; //login&logout
		public $modelAmm; //funzioni amministratore
		public $modelUser; //funzioni utente
		//costruttore

		public function __construct(){
	  
			$this->modelSession = new ModelSession();
			$this->modelAmm = new ModelAmm();
			$this->modelUser = new ModelUser();
		}

		/*Permette l'apertura delle viste a seconda del valore di $page. In questo modo si ha un unico punto d'accesso nel sito*/

		public function invoke($page){
			
			// contiene le chiamate comuni ad utente e amministratore, modellizzate nel file modelSession
			switch($page){
				case "":
				case "home":{ 
							if(isset($_SESSION['loggedAmm']) && $_SESSION['loggedAmm'] == true)
								include "view/amm/ammHomeView.php";
							else if(isset($_SESSION['loggedUser']) && $_SESSION['loggedUser'] == true)
									include "view/user/userHomeView.php";
							
								 else include "view/loginView.php";
						    break;
				}
				
				case "info":{ 
							include "view/infoView.php";
						    break;
				}			
							
				case "signin":{ 
							include "view/signinView.php";
							break;
				}
				
				case "dosignin":{
							   $username = $_REQUEST['username'];
							   $password = $_REQUEST['password'];
							   $passwordConfirm = $_REQUEST['passwordConfirm'];
							   $email = $_REQUEST['email'];
							   $nome = $_REQUEST['nome'];
							   $cognome = $_REQUEST['cognome'];
							   $sesso = $_REQUEST['sesso'];
							   $citta = $_REQUEST['citta'];
						   	   $provincia = $_REQUEST['provincia'];
							   $cap = $_REQUEST['cap'];
							   $indirizzo = $_REQUEST['indirizzo'];
							   if( isset($_REQUEST['telefono']) ) $telefono = $_REQUEST['telefono'];
							   else $telefono = "0";
							   
							   if($password !== $passwordConfirm){
									$result = "password unmatched";
									include "view/signinView.php";
							   }
							   
							   $result = $this->modelSession->getSignin($username, $password, $email, $nome, $cognome, $sesso, $citta, $provincia, $cap, $indirizzo, $telefono);
							   
							   if($result === true){
								   $result = "no errors in signin";
								   include "view/loginView.php";
							   }
							   else if($result === false){ 
								  $result = "errors in signin";
								  include "view/signinView.php";
							   }		

							   
							break;
 				}
				
				case "login":{
							$user = $_REQUEST['username'];
							$pass = $_REQUEST['password'];
							
							$result = $this->modelSession->getLogin($user, $pass);
							
							if($result === TRUE){
								if($_SESSION['loggedUser'] === TRUE) //se ha loggato un utente
									include "view/user/userHomeView.php";
								else if($_SESSION['loggedAmm'] === TRUE)// altrimenti ha loggato un admin
										include "view/amm/ammHomeView.php";
								
							}
							else{
								$result = "login error";
								include_once "view/loginView.php";
							}
							
							break;
				}
				
				case "logout":{
							$result = $this->modelSession->getLogout(); //Sloggo richiamando la getLogout()
							include "view/loginView.php";
							break;
			    }
			
				case "postDetails":{					
					include "view/postDetailsView.php";											
					break;	
                }					
				
				
				case "productList":{
					include "view/amm/listaInserzioniView.php";
					break;
				}
				
				
				// se entro qua, sono un utente o un amministratore e switcho i due ruoli
				default:{
						if(isset($_SESSION["loggedUser"]) && $_SESSION["loggedUser"] === TRUE){ //se ha loggato un utente
								include_once "controller/UserController.php"; // includo il codice del controller che lo gestisce
						}
						else if(isset($_SESSION["loggedAmm"]) && $_SESSION["loggedAmm"] === TRUE){ //se ha loggato un admin	
								include_once "controller/AmmController.php"; // includo il codice del controller che lo gestisce
							 }
							
							
						break;		
				}// end default
			}// FINE SWITCH
			
			
			
		}//fine invoke
		
	}
?>
