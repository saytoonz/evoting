<?php 


$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='$who_has_loggedin'  AND can_logine='yes' AND active='yes' LIMIT 1");
if (mysqli_num_rows($query_can_login)!==1) {
	?>
	<script type="text/javascript">
		alert('Access Denied!');
	</script>
	<?php
	logout();
}


function kill_all()
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
if ($logedin_power=="" || $logedin_id=="") {
	kill_all();
	die();
}
if ($logedin_power!="sys_1" AND $logedin_power!="sys_2" AND $logedin_power!="sys_3") {
	logout();
	die();
}
?>


<div class="inner-wrapper">
	<section class="body">
		<div class="tab-navigation collapse">
			<nav>
				<ul class="nav nav-pills">
					
					<?php 
					if ($logedin_power=="sys_2" || $logedin_power=="sys_3") {
						?>
						<li class="acess-code-staff">
							<a class="nav-link" href="generate-codes"><i class="fas fa-columns" aria-hidden="true"></i>GENERATE ACCESS CODES</a>
							
						</li>
						<?php
					}

					if ($logedin_power=="sys_1" || $logedin_power=="sys_3") {
						?>
						<li class="data">
							<a class="nav-link" href="student-staff"><i class="fas fa-columns" aria-hidden="true"></i>DATA  ENTRY</a>
						</li>
						<?php
					}

					?>
					
					
					<li class="settings">
						<a class="nav-link" href="password-staff"><i class="fas fa-copy" aria-hidden="true"></i>CHANGE ACCESS CODE</a>
						
					</li>
					
					<li>
						<a class="nav-link" href="0"><i class="fas fa-copy" aria-hidden="true"></i>Logout</a>
						
					</li>
					
				</ul>
			</nav>
		</div>
