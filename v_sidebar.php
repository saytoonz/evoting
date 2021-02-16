<?php 

 if ($logedin_power!="sys_0" || $logedin_id=="" || $access_id=="") {
 	logout();
 	die();
 
}

$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='$who_has_loggedin'  AND can_logine='yes' AND active='yes' LIMIT 1");
if (mysqli_num_rows($query_can_login)!==1) {
	?>
	<script type="text/javascript">
		alert('Access Denied!');
	</script>
	<?php
	logout();
}


?>

<div class="inner-wrapper">

	<div class="tab-navigation collapse">
		<nav>
			<ul class="nav nav-pills">
				
				<li class=" vote">
					<a class="nav-link" href="home"><i class="fas fa-columns" aria-hidden="true"></i>SRC</a>
					
				</li>
				
				<li class=" department-vote">
					<a class="nav-link" href="vote-department"><i class="fas fa-columns" aria-hidden="true"></i>Department</a>
					
				</li>

			
				
				<li>
					<a class="nav-link" href="0"><i class="fas fa-copy" aria-hidden="true"></i>Logout</a>
					
				</li>
				
			</ul>
		</nav>
	</div>
