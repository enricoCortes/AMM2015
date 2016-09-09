
<?php

	include('inc/header-top-sidebar-content.php'); 
	
	if($_SESSION['loggedUser'] === true)
		include('inc/user/userTopBar.php'); 
    else if($_SESSION['loggedAmm'] === true)
			include('inc/amm/ammTopBar.php'); 
		
	include('inc/postDetails.php'); 

	include('inc/footer.php'); 
		
?>

