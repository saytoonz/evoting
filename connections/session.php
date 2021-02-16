<?php 

session_start();

function logout()
{
	if (session_destroy()) {
		?>
		<script type="text/javascript">
			location.replace("login");
			
		</script>
		<?php
	}else{
		session_write_close();
		?>
		<script type="text/javascript">
			location.replace("login");
			
		</script>
		<?php
	}
}


if (!isset($_SESSION["master_ruler"]) && !isset($_SESSION["ruler_strength"])){
	$logedin_id="";
	$logedin_power="";
}else{
	$logedin_id = $_SESSION["master_ruler"];
	$logedin_power = $_SESSION["ruler_strength"];
}



if (!isset($_SESSION["access_id"])) {
	$access_id="";
}else{
	$access_id = $_SESSION["access_id"];
}



if (!isset($_SESSION["who_can_login_now"])) {
	$who_has_loggedin="";
}else{
	$who_has_loggedin = $_SESSION["who_can_login_now"];
}
?>




