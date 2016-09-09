

<?php
	
	switch($page){
		
		//case "ammHome": include "view/amm/ammHomeView.php"; break;
		
		case "dropUser":{
			$user = $_GET['user'];
			
			$resultDrop = $this->modelAmm->dropUser($user);		
			// non metto il break cosi rivado nella pagina di gestione degli utenti	
		}
		
		case "manageUsers":{
			
			$users = $this->modelAmm->getUsersInfo( );
			$userCount = $this->modelAmm->getUserCount( );
			include "view/amm/manageUsersView.php";
			break;
		}
		
		
		
	}// end switch


?>
