

<?php 

	include('inc/header-top-sidebar-content.php'); 

	if(isset($_SESSION['loggedUsername'])){
		if($_SESSION['loggedAmm'] === true) include('inc/amm/ammTopBar.php');
		
		else if($_SESSION['loggedUser'] === true) include('inc/user/userTopBar.php');
		
	}
	
	include('inc/userInserzioni.php'); 
	
	include('inc/footer.php'); 
	
?>