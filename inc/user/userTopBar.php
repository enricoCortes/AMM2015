
<div id = "userTopBar">

	<p class = "welcome"> Benvenuto <b> <?php echo $_SESSION['loggedUsername']; ?> </b> </p>  &nbsp; 
	
	<a href = "index.php?page=home"> <p class = "linkAccount"> Home page </p></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	<a href = "index.php?page=manageAccount"> <p class = "linkAccount"> My Account </p></a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	
	<form action = "index.php?page=nuovaInserzione" method = "post"> 
		<input type = "submit" value = "Vendi una chitarra" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	</form>
	
	<form action = "index.php?page=logout" method = "post">
		<input type = "submit" value = "Logout" /> 
	</form>
	
	<hr/>
	
</div>