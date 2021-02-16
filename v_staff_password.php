
<?php

include 'connections/config.php';

$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='$who_has_loggedin'  AND can_logine='yes' AND active='yes' LIMIT 1");
if (mysqli_num_rows($query_can_login)!==1) {
	?>
	<script type="text/javascript">
		alert('Access Denied!');
	</script>
	<?php
	logout();
}



if ($logedin_power=="" || $logedin_id=="") {
	logout();
	die();
}

if ($logedin_power!="sys_1" AND $logedin_power!="sys_2" AND $logedin_power!="sys_3") {
	logout();
	die();
}


$admin_name = "";
$queryInfo = mysqli_query($conn, "SELECT * FROM staffs WHERE id='$logedin_id' AND active='yes'");
if (mysqli_num_rows($queryInfo)!==0) {

	$fetch =mysqli_fetch_assoc($queryInfo);
	$staff_name = $fetch["name"];

}else{
	logout();
	die();
}



$title = "Change Access Code";
include 'v_header.php'; 
?>



<?php include 'v_sidebar_staff.php'; ?>

<section role="main" class="content-body tab-menu-opened">
	<header class="page-header page-header-left-breadcrumb">
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a>
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span>SETTINGS</span></li>
				<li><span>Change Access Code</span></li>
			</ol>


		</div>

		<h2>Welcome <b><?php echo $staff_name  ?></b></h2>
	</header>

	<div class="row">
		<div class="col-lg-12">
			<form method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="validate()">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">Change Access</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Current Access Code: </label>
							<div class="col-sm-8">
								<input type="password" name="oldpass" class="form-control" required>

							</div>
						</div>
						

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">New Access Code: </label>
							<div class="col-sm-8">
								<input type="password" name="npass" id="password" class="form-control" required>

							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Confirm Access Code: </label>
							<div class="col-sm-8">
								<input type="password" name="cpass" id="confirm_password" class="form-control" required>

							</div>
						</div>
						
						
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-success" name="submit" >Update </button>
						<button type="reset" class="btn btn-default">Reset</button>
					</footer>
				</section>
			</form>
		</div>


		
	</div>
</section>
</div>




<?php include 'v_footer.php'; ?>

<script type="text/javascript">

	$(document).ready(function(){
		$('.settings').addClass('nav-expanded nav-active');
	});

	

	function validate(){

		var a = document.getElementById("password").value;
		var b = document.getElementById("confirm_password").value;
		if (a!=b) {
			alert("New Passwords do no match");
			return false;
		}


	}

</script>



<?php 
if (isset($_POST["submit"])) {
	
	if ($logedin_id=="" || ($logedin_power!="sys_1" AND $logedin_power!="sys_2" AND $logedin_power!="sys_3")) {
		logout();
		die();
	}

	$oldpass = strip_tags(htmlentities(stripslashes($_POST["oldpass"])));
	$npass = strip_tags(htmlentities(stripslashes($_POST["npass"])));
	$cpass = strip_tags(htmlentities(stripslashes($_POST["cpass"])));

	$md5_oldpass = md5(md5(md5(md5(md5(md5($oldpass))))));


	if (!empty($oldpass) && !empty($npass) && !empty($cpass)) {
		if ($npass == $cpass) {
			$search_q = mysqli_query($conn,"SELECT * FROM staffs WHERE id='$logedin_id' AND access_code='$md5_oldpass' AND active='yes' LIMIT 1");
			if (mysqli_num_rows($search_q)===1) {
				
				$md5_new = md5(md5(md5(md5(md5(md5($cpass))))));

				mysqli_query($conn,"UPDATE staffs SET access_code='$md5_new' WHERE id = '$logedin_id' AND active='yes'");

				?>
				<script type="text/javascript">
					alert("Password Changed Successfully!");
					location.replace("");
				</script>
				<?php

			}else{
				?>
				<script type="text/javascript">
					alert("Incorrect Current Password!!!");
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert("New Passwords do not match!");
			</script>
			<?php	
		}
	}else{
		?>
		<script type="text/javascript">
			alert("All fields are required.");
		</script>
		<?php
	}


}

?>
<?php include 'connections/close_config.php'; ?>