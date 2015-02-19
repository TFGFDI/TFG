<?php 
session_start();

if (($_SESSION["id"]=="")){ 

header("Location: login.php");

}
require_once("top.php"); 
?>

	<div id="central">
		<div class="menu"> 
			<ul>
				<li><a href="#">Link one</a></li>
				<li><a href="#">Link two</a></li>
				<li><a href="#">Link three</a></li>
				<li><a href="#">Link four</a></li>
			</ul>
		</div>
	</div>
	
<?php

require_once("bottom.php"); 

?>