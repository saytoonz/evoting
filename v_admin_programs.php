
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






$title = "Programs";
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
				<li><span>MANAGEMENT</span></li>
				<li><span>Programs</span></li>
			</ol>


		</div>

		<h2>Welcome <b><?php echo $admin_name  ?></b></h2>
	</header>

	<div class="row">
		<div class="col-lg-4">
			<form method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">Add Program</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Select Department: </label>
							<div class="col-sm-8">
								<select class="form-control" name="program_department_program_campus" required="required">
									<?php 
									$query_departments = mysqli_query($conn, "SELECT * FROM departments WHERE active='yes' ORDER BY name ASC");
									if (mysqli_num_rows($query_departments)!==0) {
										?>
										<option selected disabled value="">Choose Department</option>
										<?php
										while ($fetch_departments = mysqli_fetch_assoc($query_departments)) {
											$dep_uid = $fetch_departments["id"];
											$department_name = $fetch_departments["name"];
											$campus_id = $fetch_departments["campus"];

											$campus_name = "Unknown Campus";
											$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
											if (mysqli_num_rows($query_c)!==0) {
												$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
											}
											?>
											<option value="<?php echo "$dep_uid,$campus_id" ?>"><?php echo "$department_name ($campus_name)" ?></option>
											<?php
										}
									}else{
										?>
										<option selected disabled value="">No campus found</option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Program Name: </label>
							<div class="col-sm-8">
								<input type="text" name="newProgramName" class="form-control" required="required">
							</div>
						</div>
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="createDepartment">Submit </button>
						<button type="reset" class="btn btn-default">Reset</button>
					</footer>
				</section>
			</form>
		</div>


		<div class="col-lg-8">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
					</div>

					<h2 class="card-title">Added Programs</h2>
				</header>
				<div class="card-body">


					<?php 

					$query_program= mysqli_query($conn, "SELECT * FROM programs WHERE active='yes'");
					if (mysqli_num_rows($query_program)!==0) {
						?>

						<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
							<thead>
								<tr>
									<th>Program Name</th>
									<th>Department</th>
									<th>Campus</th>
									<th>Action</th>

								</tr>
							</thead>
							<?php 
							while ($fetch_departments = mysqli_fetch_assoc($query_program)) {
								$uid = $fetch_departments["id"];
								$program_name = $fetch_departments["name"];
								$department_id = $fetch_departments["department"];
								$campus_id = $fetch_departments["campus"];

								$campus_name = "Unknown Campus";
								$department_name = "Unknown Department";
								$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
								if (mysqli_num_rows($query_c)!==0) {
									$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
								}


								$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$department_id' AND active='yes'");
								if (mysqli_num_rows($query_d)!==0) {
									$department_name = mysqli_fetch_assoc($query_d)["name"];
								}

								
								?>
								<tbody>
									<tr>
										<td><?php echo $program_name; ?></td>
										<td><?php echo  $department_name; ?></td>
										<td><?php echo  $campus_name; ?></td>

										<td class="actions-hover actions-fade">
											<a href="#editProgram<?php echo $uid ?>" class="modal-with-form"><i class="fas fa-pencil-alt"></i></a>
											<a href="#deleteBox<?php echo $uid ?>" class="modal-with-move-anim"><i class="far fa-trash-alt"></i></a>
										</td>	
									</tr>
								</tbody>




								<!-- --------------------------------- edit program modal --------------------------------- -->

								<div id="editProgram<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-info mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Update program Info</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<div class="card-body">

												<div class="form-row">
													<div class="form-group col-md-6">
														<label>Program Name</label>
														<input type="text" name="editProgramName<?php echo $uid ?>" class="form-control" placeholder="Program Name" value="<?php echo $program_name; ?>" required />
													</div>
													<div class="form-group col-md-6 mb-3 mb-lg-0">
														<label>Department</label>
														<select class="form-control" name="program_department_program_campus<?php echo $uid ?>" required>
															<?php 
															$query_departments = mysqli_query($conn, "SELECT * FROM departments WHERE active='yes' ORDER BY name ASC");
															if (mysqli_num_rows($query_departments)!==0) {
																?>
																<option selected disabledvalue="<?php echo "$department_id,$campus_id" ?>"><?php echo "$department_name ($campus_name)" ?></option>
																<?php
																while ($fetch_departments = mysqli_fetch_assoc($query_departments)) {
																	$dep_uid = $fetch_departments["id"];
																	$department_name = $fetch_departments["name"];
																	$campus_id = $fetch_departments["campus"];

																	$campus_name = "Unknown Campus";
																	$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
																	if (mysqli_num_rows($query_c)!==0) {
																		$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
																	}
																	?>
																	<option value="<?php echo "$dep_uid,$campus_id" ?>"><?php echo "$department_name ($campus_name)" ?></option>
																	<?php
																}
															}else{
																?>
																<option selected disabled value="">No campus found</option>
																<?php
															}
															?>
														</select>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button type="submit" class="btn btn-info" name="editProgram<?php echo $uid ?>">Update</button>
													</div>
												</div>
											</footer>
										</form>
										
										
									</section>
								</div>
								<!-- ---------------------------------  end of edit Program modal --------------------------------- -->

								<!-- --------------------------------- delete Program modal --------------------------------- -->
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
														<p>Are sure you want to delete this Program completely? This action is not reversible.</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button class="btn btn-danger" type="submit" name="delete_Department<?php echo $uid ?>">Yes! Delete!</button>

													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- --------------------------------- end of delete Program modal --------------------------------- -->




								<?php

								if (isset($_POST["delete_Department$uid"])) {
									mysqli_query($conn, "UPDATE programs SET active='no' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}






								if (isset($_POST["editProgram$uid"])) {
									
									if ($logedin_id=="" || $logedin_power!="sys_4") {
										logout();
										die();
									}


									$name = strip_tags(htmlentities(stripslashes($_POST["editProgramName$uid"])));
									$department_campus = $_POST["program_department_program_campus$uid"];

									$newDepCamp = explode(",", $department_campus);


									$department = strip_tags(htmlentities(stripslashes(current($newDepCamp))));
									$campus = strip_tags(htmlentities(stripslashes(next($newDepCamp))));

									


									if (is_numeric($department) && is_numeric($campus)) {
										mysqli_query($conn, "UPDATE programs SET name='$name',campus='$campus',department='$department' WHERE id='$uid
											' AND active='yes'");
										?><script type="text/javascript">location.replace("");</script><?php
									}else{
										?>
										<script type="text/javascript">
											alert("Sorry, can't identify editing Department, refresh page and try again.");
										</script>
										<?php
									}


								}
								





								
							}
							?>

						</table>



						<?php
					}else{
						echo no_program();
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
		$('.program').addClass('nav-active');
		$('.management').addClass('nav-expanded nav-active');
	});
</script>


<?php 

if (isset($_POST["createDepartment"])) {
	
	if ($logedin_id=="" || $logedin_power!="sys_4") {
		logout();
		die();
	}

	$name = strip_tags(htmlentities(stripslashes($_POST["newProgramName"])));
	$department_campus = $_POST["program_department_program_campus"];

	$newDepCamp = explode(",", $department_campus);


	$department = strip_tags(htmlentities(stripslashes(current($newDepCamp))));
	$campus = strip_tags(htmlentities(stripslashes(next($newDepCamp))));


	if (!empty($department) && !empty($campus) && !empty($name)) {
		if (is_numeric($campus) && is_numeric($department)) {

			mysqli_query($conn, "INSERT INTO programs(name,campus,department) VALUES('$name','$campus','$department')");
			?><script type="text/javascript">location.replace("");</script><?php

		}else{
			?>
			<script type="text/javascript">
				alert("Unknown error occured....");
				window.reload();
			</script>
			<?php
		}
	}else{
		?>
		<script type="text/javascript">
			alert("Both Department name and campus are required.");
		</script>
		<?php
	}

	
}



?>

<?php include 'connections/close_config.php'; ?>