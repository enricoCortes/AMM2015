

<div id = "userTopBar">

	<p class = "welcome"> Benvenuto <b> <?php echo $_SESSION['loggedUsername']; ?> </b> </p>  &nbsp; &nbsp; 
	
	<form action = "index.php?page=home" method = "post">
		<input type = "submit" value = "Home" /> 
	</form>
	
	&nbsp; &nbsp; &nbsp; &nbsp; 
	
	<form action = "index.php?page=logout" method = "post">
		<input type = "submit" value = "Logout" /> 
	</form>
	
	<hr/>
	
</div>