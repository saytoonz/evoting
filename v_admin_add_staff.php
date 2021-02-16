
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

if ($logedin_power!="sys_4" || $logedin_id=="") {
	logout();
	die();
}

$admin_name = "";
$queryInfo = mysqli_query($conn, "SELECT * FROM system_admin WHERE id='$logedin_id' AND active='yes'");
if (mysqli_num_rows($queryInfo)!==0) {

	$fetch =mysqli_fetch_assoc($queryInfo);
	$admin_name = $fetch["name"];

}else{
	logout();
	die();
}


$qquery = mysqli_query($conn,"SELECT * FROM staffs");
$row = mysqli_num_rows($qquery);
$lastid = $row+1;


if ($lastid <= 9) {
	$lastid = "000$lastid";
}elseif ($lastid <=99) {
	$lastid = "00$lastid";
}elseif ($lastid <=999) {
	$lastid = "0$lastid";
}elseif ($lastid <=9999) {
	$lastid = "$lastid";
}


$new_StaffID = "V_UE$lastid";


$title = "Add Staff";
include 'v_header.php'; 

?>



<?php include 'v_sidebar_admin.php'; ?>

<section role="main" class="content-body tab-menu-opened">
	<header class="page-header page-header-left-breadcrumb">
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a>
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span>ROLE/SETTINGS</span></li>
				<li><span>Add Staff</span></li>
			</ol>


		</div>

		<h2>Welcome <b><?php echo $admin_name  ?></b></h2>
	</header>

	<div class="row">
		<div class="col-lg-3">
			<form method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">Add Staff</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Full Name: </label>
							<div class="col-sm-8">
								<input type="text" name="full_name" class="form-control" required="required">

							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Role: </label>
							<div class="col-sm-8">
								<select class="form-control" name="role" required="required">
									<option value="" selected disabled>Select Role</option>
									<option value="role_1">Add Students</option>
									<option value="role_2">Generate AcessCode</option>
									<option value="role_3">Both</option>
								</select>

							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Staff ID.: </label>
							<div class="col-sm-8">
								<input type="text" name="staff_id" class="form-control" readonly required  value="<?php echo $new_StaffID ?>">

							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Access Code: </label>
							<div class="col-sm-8">
								<input type="text" name="accessCode" class="form-control" id="accessCode" maxlength="6" readonly required>

							</div>

						</div>
						<br>
						<inmo class="btn btn-primary float-right ren" onclick="$('#accessCode').val(generateRandomAccessCode(6))">Generate Access Code</inmo>
						
						
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-danger" name="AddNewstaff">Submit </button>
						<button type="reset" class="btn btn-default">Reset</button>
					</footer>
				</section>
			</form>
		</div>


		<div class="col-lg-9">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
					</div>

					<h2 class="card-title">Added staff Data</h2>
				</header>
				<div class="card-body">

					<?php 

					$query_staffs = mysqli_query($conn, "SELECT * FROM staffs WHERE active='yes' ORDER BY id ASC");
					if (mysqli_num_rows($query_staffs)!==0) {
						?>
						<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
							<thead>
								<tr>
									<th>Full Name</th>
									<th>Staff ID</th>
									<th>Role</th>
									<th>Added Students</th>
									<th>Gen. Codes</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<?php 
							while ($fetch_staffs = mysqli_fetch_assoc($query_staffs)) {
								$uid = $fetch_staffs["id"];
								$name = $fetch_staffs["name"];
								$staff_id = $fetch_staffs["staff_id"];
								$priority = $fetch_staffs["priority"];
								$num_gen_codes = $fetch_staffs["num_gen_codes"];
								$num_added_stdnts = $fetch_staffs["num_added_stdnts"];
								$reset_code = $fetch_staffs["reset_code"];


								$role="unknown";
								if ($priority=="role_1") {$role = "Add Students"; }
								elseif ($priority=="role_2") {$role="Generate AcessCode"; }
								elseif ($priority=="role_3") {$role="Both"; }
								?>
								<tbody>
									<tr>
										<td><?php echo $name ?></td>
										<td><?php echo $staff_id ?></td>
										<td><?php echo $role ?></td>
										<th><?php echo $num_added_stdnts ?></th>
										<th><?php echo $num_gen_codes ?></th>



										<td class="actions-hover actions-fade">
											<a href="#resetBox<?php echo $uid ?>" class="modal-with-move-anim"><i class="fas fa-window-restore"></i></a>
											<a href="#editStaff<?php echo $uid ?>" class="modal-with-form"><i class="fas fa-pencil-alt"></i></a>
											<a href="#deleteBox<?php echo $uid ?>" class="modal-with-move-anim"><i class="far fa-trash-alt"></i></a>
										</td>


									</tr>


								</tbody>




								<!-- ---------------------------------- delete Staff modal ---------------------------------- -->
								<div id="deleteBox<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-danger mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Delete Confirmation</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-times-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Irreversible Action!</h4>
														<p>Are sure you want to delete this Staff completely? This action is not reversible.</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button class="btn btn-danger" type="submit" name="deleteStaff<?php echo $uid ?>">Yes! Delete!</button>
													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- ---------------------------------- end of delete Staff modal ---------------------------------- -->





								<!-- ---------------------------------- reset Staff modal ---------------------------------- -->
								<div id="resetBox<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-danger mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Staff Information Reset</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<input type="hidden" name="delete" value="<?php echo 'id' ?>">
											<div class="card-body">
												<div class="modal-wrapper">
													<div class="modal-icon">
														<i class="fas fa-times-circle"></i>
													</div>
													<div class="modal-text">
														<h4>Dangerous Action!</h4>
														<p>Reseting Staff will clear all data of this staff and reset his/her access code. This action is not reversible.</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button class="btn btn-danger" type="submit" name="resetStaff<?php echo $uid ?>">Yes! Reset!</button>

													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- ---------------------------------- end of reset Staff modal ---------------------------------- -->





								<!-- ---------------------------------- edit Staff modal ---------------------------------- -->
								<div id="editStaff<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-info mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Update Staff Info</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<div class="card-body">

												<div class="form-row">
													<div class="form-group col-md-6">
														<label >Staff Name</label>
														<input type="text" class="form-control" name="editStaff_name<?php echo $uid ?>" placeholder="Staff Name" value="<?php echo $name ?>" required>
													</div>
													
													<div class="form-group col-md-6 mb-3 mb-lg-0">
														<label>Staff Role</label>
														<select  class="form-control" name="editRole<?php echo $uid ?>" required>	
															<option value="<?php echo $priority ?>" selected><?php echo $role ?></option>
															<option value="role_1">Add Students</option>
															<option value="role_2">Generate AcessCode</option>
															<option value="role_3">Both</option>
														</select>
													</div>
												</div>
												
												<footer class="card-footer">
													<div class="row">
														<div class="col-md-12 text-right">
															<button class="btn btn-default modal-dismiss">Cancel</button>
															<button type="submit" class="btn btn-info" name="editStaffInfo<?php echo $uid ?>">Update</button>
														</div>
													</div>
												</footer>
											</div>
										</form>
									</section>
								</div>
								<!-- ---------------------------------- end of edit Staff modal ---------------------------------- -->

								<?php
								if (isset($_POST["deleteStaff$uid"])) {
									
									if ($logedin_id=="" || $logedin_power!="sys_4") {
										logout();
										die();
									}
									mysqli_query($conn, "UPDATE staffs SET active='no' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}



								if (isset($_POST["resetStaff$uid"])) {
									
									if ($logedin_id=="" || $logedin_power!="sys_4"  ) {
										logout();
										die();
									}
									$md5_reset_code = md5(md5(md5(md5(md5(md5($reset_code))))));
									mysqli_query($conn, "UPDATE staffs SET access_code='$md5_reset_code',num_gen_codes='0',num_added_stdnts='0' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}



								if (isset($_POST["editStaffInfo$uid"])) {
									
									if ($logedin_id=="" ||  $logedin_power!="sys_4") {
										logout();
										die();
									}


									$full_name = strip_tags(stripslashes(htmlentities($_POST["editStaff_name$uid"])));
									$role = strip_tags(stripslashes(htmlentities($_POST["editRole$uid"])));

									if (!empty($full_name) && !empty($role)) {
										
										mysqli_query($conn, "UPDATE staffs SET name='$full_name',priority='$role' WHERE id='$uid' AND active='yes'");
										?><script type="text/javascript">location.replace("");</script><?php

									}else{
										?>
										<script type="text/javascript">
											alert("Sorry all fields are required.");
										</script>
										<?php
									}
									
								}
							}
							?>

						</table>



						<?php

					}else{
						echo no_staff_added();
					}



					?>
					
				</div>
			</section>
		</div>
	</div>
</section>
</div>



<?php include 'v_footer.php'; ?>

<script type="text/javascript">


	$(document).ready(function(){
		$('.staff').addClass('nav-active');
		$('.settings').addClass('nav-expanded nav-active');
		$('#accessCode').val(generateRandomAccessCode(6));
	});

	function generateRandomAccessCode(length){
		var results = '';
		var characters = '1234567890asdfghjkmnbvcxzqweruiopASDFGHJKVCVBJKLPOIUYTRE';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			results += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return results;
	}

	$('.ren').click(function(){
		$('.ren').html('Re-Generate Access Code');
	});
</script>


<?php 

if (isset($_POST["AddNewstaff"])) {

	if ($logedin_power!="sys_4" || $logedin_id=="") {
		logout();
		die();
	}


	$full_name = strip_tags(stripslashes(htmlentities($_POST["full_name"])));
	$role = strip_tags(stripslashes(htmlentities($_POST["role"])));
	$staff_id = strip_tags(stripslashes(htmlentities($_POST["staff_id"])));
	$accessCode = strip_tags(stripslashes(htmlentities($_POST["accessCode"])));

	$md5_accessCode = md5(md5(md5(md5(md5(md5($accessCode))))));


	if (!empty($full_name) && !empty($role) && !empty($staff_id) && !empty($accessCode)) {
		$serch_q = mysqli_query($conn, "SELECT * FROM staffs WHERE staff_id='$staff_id'");
		
		if (mysqli_num_rows($serch_q)===0) {													
			mysqli_query($conn, "INSERT INTO staffs(name,staff_id,priority,access_code,reset_code,added_by ) VALUES('$full_name','$staff_id','$role','$md5_accessCode','$accessCode','$logedin_id')");
			?><script type="text/javascript">location.replace("")</script><?php
		}else{
			?>
			<script type="text/javascript">
				alert("Staff ID is already in use by another person\n\ncontact technicians if it continue like this.");
			</script>
			<?php
		}
		
	}else{
		?>
		<script type="text/javascript">
			alert("Sorry all fields are required.");
		</script>
		<?php
	}
}


?>




<?php include 'connections/close_config.php'; ?>