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
if ($logedin_power!="sys_4" || $logedin_id=="") {
	kill_all();
	die();
}

?>
<div class="inner-wrapper">

	<div class="tab-navigation collapse">
		<nav>
			<ul class="nav nav-pills">
				
				
				<li class="dropdown management">
					<a class="nav-link dropdown-toggle"><i class="fas fa-columns" aria-hidden="true"></i>MANAGEMENT</a>
					<ul class="dropdown-menu">
						<li class="campus">
							<a class="nav-link" href="admin-cp">Campuses</a>
							
						</li>
						<li class="department">
							<a class="nav-link" href="departments">Department</a>
							
						</li>
						<li class="program">
							<a class="nav-link" href="programs">Programs</a>
							
						</li>
						
					</ul>
				</li>

				<li class="dropdown data">
					<a class="nav-link dropdown-toggle"><i class="fas fa-columns" aria-hidden="true"></i>DATA  ENTRY</a>
					<ul class="dropdown-menu">
						<li class="student-type">
							<a class="nav-link" href="student-type">Student Types</a>
							
						</li>
						<li class="student-data">
							<a class="nav-link" href="student-data">Student Data</a>
							
						</li>
						
					</ul>
				</li>
				<li class="vote">
					<a class="nav-link " href="candidates-data" ><i class="fas fa-columns" aria-hidden="true"></i>CANDIDATES</a>
					
				</li>
				<li class="dropdown settings">
					<a class="nav-link dropdown-toggle"><i class="fas fa-copy" aria-hidden="true"></i>Role/Settings</a>
					<ul class="dropdown-menu">
						<li class=" staff">
							<a class="nav-link" href="staff">Add Staff</a>
							
						</li>
						<li class=" password">
							<a class="nav-link" href="password">Change Password</a>
							
						</li>
						
					</ul>
				</li>
				
				<li>
					<a href="0" class="nav-link"><i class="fas fa-copy" aria-hidden="true"></i>Logout</a>
					
				</li>
				
			</ul>
		</nav>
	</div>
