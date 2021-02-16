
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





$sesSection = "";
if (isset($_SESSION["sesSection"])) {
	$sesSection = $_SESSION["sesSection"];
}

$sesDesignation = "";
if (isset($_SESSION["sesDesignation"])) {
	$sesDesignation = $_SESSION["sesDesignation"];
}

$sesDepartment = "";
if (isset($_SESSION["sesDepartment"])) {
	$sesDepartment = $_SESSION["sesDepartment"];
}




$title = "Candidates Data";
include 'v_header.php';
?>



<?php include 'v_sidebar_admin.php'; ?>

<section role="main" class="content-body tab-menu-opened">
	<header class="page-header page-header-left-breadcrumb">
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a href="home">
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span>CANDIDTATES</span></li>
				<li><span>Candidates Data</span></li>
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

						<h2 class="card-title">Add Candidate Data</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Index Number: </label>
							<div class="col-sm-8">
								<input type="text" name="index_number" class="form-control" required>

							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Section: </label>
							<div class="col-sm-7">
								<select class="form-control section" name="section" required>
									<?php 

									if ($sesSection=="") {
										?>
										<option disabled selected value="">Select Section</option>
										<?php
									}else{
										?>
										<option selected value="<?php echo $sesSection ?>"><?php echo $sesSection ?></option>
										<?php
									}

									?>
									<option value="SRC">SRC</option>
									<option value="Department">Department</option>

								</select>
								
							</div>

							<?php 

							if ($sesSection=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_sec" data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_sec" data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked>
								<?php
							}

							?>
							
						</div>					
						
						

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Designation: </label>
							<div class="col-sm-7">
								<select class="form-control designation" name="designation" required>

									<?php 

									if ($sesDesignation=="") {
										?>
										<option disabled selected value="">Select Designation</option>
										<?php
									}else{
										?>
										<option selected value="<?php echo $sesDesignation ?>"><?php echo $sesDesignation ?></option>
										<?php
									}

									?>
									<option class="src">President</option>
									<option class="src">Secretary</option>
									<option class="src">Financial Secretary</option>
									<option class="department">President</option>
									<option class="department">Secretary</option>
									<option class="department">Financial Secretary</option>
									<option class="department">General Organizer</option>
									<option class="department">Member of Parliament</option>
									<option class="department">Public Relations Officer(P.R.O)</option>
									
								</select>
							</div>


							<?php 

							if ($sesDesignation=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_desi"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_desi"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked>
								<?php
							}

							?>
							
						</div>
						<div class="form-group row" style="display: none;" id="department">
							<label class="col-sm-4 control-label text-sm-right pt-2">Department: </label>
							<div class="col-sm-7">
								<select class="form-control" name="department">

									<?php 

									if ($sesDepartment=="") {
										?>
										<option disabled selected value="">Select Department</option>
										<?php
									}else{
										$department_name ="Unknown";
										$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$sesDepartment' AND active='yes'");
										if (mysqli_num_rows($query_d)!==0) {
											$get = mysqli_fetch_assoc($query_d);
											$department_ = $get["name"];
											$campus_id = $get["campus"];

											$campus_name = "Unknown Campus";
											$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
											if (mysqli_num_rows($query_c)!==0) {
												$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
											}									

											$department_name = "$department_ ($campus_name)";

										}
										?>
										<option selected value="<?php echo $sesDepartment ?>"><?php echo $department_name ?></option>
										<?php
									}




									$query_departments = mysqli_query($conn, "SELECT * FROM departments WHERE active='yes' ORDER BY name ASC");
									if (mysqli_num_rows($query_departments)!==0) {
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
											<option value="<?php echo "$dep_uid" ?>"><?php echo "$department_name ($campus_name)" ?></option>
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

							<?php 

							if ($sesDepartment=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_dep"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chk_dep"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked>
								<?php
							}

							?>

						</div>
						<div class="form-group row" style="display: none !important;">
							<label class="col-sm-4 control-label text-sm-right pt-2">Candidate ID: </label>
							<div class="col-sm-8">
								<input type="text" name="candidate_id" class="form-control" readonly id="candidateId" required>

							</div>
						</div>
						<div class="form-group row" style="display: none !important;">
							<label class="col-sm-4 control-label text-sm-right pt-2"><i class="fas fa-arrow-right"></i> </label>
							<div class="col-sm-8">
								<inmo class="btn btn-primary ren container-fluid" onclick="$('#candidateId').val(generateRandomAccessCode(6))">Generate ID</inmo>
							</div>
						</div>



					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="submit">Submit </button>
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

					<h2 class="card-title">Added Candiate Data</h2>
				</header>
				<div class="card-body">

					<?php 

					$query_staffs = mysqli_query($conn, "SELECT * FROM candidates WHERE active='yes' ORDER BY section DESC");
					if (mysqli_num_rows($query_staffs)!==0) {
						?>
						<table class="table table-bordered table-striped table-hover mb-0  table-responsive-lg">
							<thead>
								<tr>
									<th>Full Name</th>
									<th>Index Number</th>
									<th>Program</th>
									<th>Section</th>
									<th>Department</th>
									<th>Designation</th>
									<th>Action</th>

								</tr>
							</thead>
							<?php 
							while ($fetch_staffs = mysqli_fetch_assoc($query_staffs)) {
								$uid = $fetch_staffs["id"];
								$student_id = $fetch_staffs["student_id"];
								$section = $fetch_staffs["section"];
								$designation = $fetch_staffs["designation"];
								$department_id_if = $fetch_staffs["department_if"];
								$reset_pass = $fetch_staffs["reset_pass"];

								$student_name = "";
								$student_index = "";
								$program = "";
								$department_name = "Unknown";
								$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
								if (mysqli_num_rows($queryInfo)!==0) {

									$fetch =mysqli_fetch_assoc($queryInfo);
									$firstname = $fetch["firstname"];
									$surname = $fetch["surname"];
									$lastname = $fetch["lastname"];
									$program_id= $fetch["program"];

									$student_index = $fetch["index_number"];
									$student_name = "$firstname $surname $lastname";


									$query_p = mysqli_query($conn, "SELECT * FROM programs WHERE id='$program_id' AND active='yes'");
									if (mysqli_num_rows($query_p)!==0) {
										$program = mysqli_fetch_assoc($query_p)["name"];
									}


								}else{
									$student_name = "Unknown";
									$student_index = "Unknown";
									$program = "Unknown";
								}

								$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$department_id_if' AND active='yes'");
								if (mysqli_num_rows($query_d)!==0) {
									$get = mysqli_fetch_assoc($query_d);
									$department_ = $get["name"];
									$campus_id = $get["campus"];

									$campus_name = "Unknown Campus";
									$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
									if (mysqli_num_rows($query_c)!==0) {
										$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
									}									

									$department_name = "$department_ ($campus_name)";

								}


								if ($section=="SRC") {
									$department_name="____";
								}

								?>



								<tbody>
									<tr>
										<td><?php echo $student_name ?></td>
										<td><?php echo $student_index ?></td>
										<td><?php echo $program ?></td>
										<td><?php echo $section ?></td>
										<td><?php echo $department_name ?></td>
										<td><?php echo $designation ?></td>


										<td class="actions-hover actions-fade">
											<a href="#deleteBox<?php echo $uid ?>" class="modal-with-move-anim"><i class="far fa-trash-alt"></i></a>
										</td>


									</tr>


								</tbody>








								<!-- delete Candidate modal -->
								<div id="deleteBox<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-danger mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Delete Confirmation</h2>
										</header>

										<div class="card-body">
											<div class="modal-wrapper">
												<div class="modal-icon">
													<i class="fas fa-times-circle"></i>
												</div>
												<div class="modal-text">
													<h4>Hello Friend!</h4>
													<p>Are sure you want to delete this Candidate completely? This action is not reversible.</p>
												</div>
											</div>
										</div>
										<form method="post" enctype="multipart/form-data">
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button class="btn btn-danger" type="submit" name="deleteCand<?php echo $uid ?>">Yes! Delete!</button>

													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- end of delete Candidate modal -->



								<?php
								if (isset($_POST["deleteCand$uid"])) {

									if ($logedin_id=="" || $logedin_power!="sys_4") {
										logout();
										die();
									}
									mysqli_query($conn, "UPDATE candidates SET active='no' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}

							}
							?>

						</table>



						<?php

					}else{
						echo no_candidate_added();
					}



					?>
				</div>
			</section>
		</div>
	</div>
</section>
</div>



</section>



<?php include 'v_footer.php'; ?>

<script type="text/javascript">
	function generateRandomAccessCode(length){
		var results = '';
		var characters = '1234567890asdfghjkmnbvcxzqweruiopASDFGHJKVCVBJKLPOIUYTRE';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			results += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return results;
	}

	$(document).ready(function(){
		$('.vote').addClass('nav-expanded nav-active');
		$('.department').hide();
		$('.section').change(function(){
			if ($(this).val()=='SRC') {
				$('.designation').find(function(){
					$('.department').hide();
					$('.src').show();
					$('#department').hide('fadeInDown');
				});
			}else{
				if($(this).val()=='Department') {
					$('.designation').find(function(){
						$('.src').hide();
						$('.department').show();
						$('#department').show('fadeInUp');
					});
				}
			}
		});
		$('#candidateId').val(generateRandomAccessCode(6));
		$('.ren').click(function(){
			$('.ren').html('Re-Generate ID');
		});


		if ($('.section').val()=='SRC') {
			$('.designation').find(function(){
				$('.department').hide();
				$('.src').show();
				$('#department').hide('fadeInDown');
			});
		}else{
			if($('.section').val()=='Department') {
				$('.designation').find(function(){
					$('.src').hide();
					$('.department').show();
					$('#department').show('fadeInUp');
				});
			}
		}

	});

</script>






<?php 

if (isset($_POST["submit"])) {

	if ($logedin_id=="" || $logedin_power!="sys_4") {
		logout();
		die();
	}

	$chk_sec = strip_tags(stripslashes(htmlentities(@$_POST["chk_sec"])));
	$chk_desi = strip_tags(stripslashes(htmlentities(@$_POST["chk_desi"])));
	$chk_dep = strip_tags(stripslashes(htmlentities(@$_POST["chk_dep"])));


	$index_number = strip_tags(stripslashes(htmlentities($_POST["index_number"])));
	$section = strip_tags(stripslashes(htmlentities($_POST["section"])));
	$designation = strip_tags(stripslashes(htmlentities($_POST["designation"])));
	$department = strip_tags(stripslashes(htmlentities(@$_POST["department"])));
	$candidate_id = strip_tags(stripslashes(htmlentities($_POST["candidate_id"])));

	if ($chk_sec == true) {$_SESSION["sesSection"]=$section; }else{$_SESSION["sesSection"]=""; }
	if ($chk_desi == true) {$_SESSION["sesDesignation"]=$designation; }else{$_SESSION["sesDesignation"]=""; }
	if ($chk_dep == true) {$_SESSION["sesDepartment"]=$department; }else{$_SESSION["sesDepartment"]=""; }


	if (!empty($section) && !empty($designation) && !empty($index_number) && !empty($candidate_id)) {

		if (($section=="Department" && $department !="") ||  $section != "Department") {
			
			$search_q = mysqli_query($conn, "SELECT id,campus FROM students WHERE index_number='$index_number' AND active='yes' LIMIT 1");
			if (mysqli_num_rows($search_q)===1) {
				$grab = mysqli_fetch_assoc($search_q);
				$student_id =$grab["id"];
				$student_campus = $grab["campus"];


				$search_q = mysqli_query($conn, "SELECT * FROM candidates WHERE student_id='$student_id' AND active='yes' LIMIT 1");
				
				if (mysqli_num_rows($search_q)===0) {

					$login_pass = md5(md5(md5(md5(md5(md5($candidate_id))))));

					if (mysqli_query($conn, "INSERT INTO candidates(student_id, section, designation, department_if, campus, login_pass, reset_pass) VALUES('$student_id','$section','$designation','$department', '$student_campus','$login_pass','$candidate_id')")) {

						$search_cand = mysqli_query($conn, "SELECT * FROM candidates WHERE student_id='$student_id' AND active='yes' LIMIT 1");
						$get = mysqli_fetch_assoc($search_cand);
						$cand_id =$get["id"];

						$search_q = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$cand_id' AND active='yes' LIMIT 1");

						if (mysqli_num_rows($search_q)===0) {
							mysqli_query($conn, "INSERT INTO contestants(cand_id) VALUES('$cand_id')");
						}

						
						?>
						<script type="text/javascript">
							location.replace("");
						</script>
						<?php
					}

				}else{
					?>
					<script type="text/javascript">
						alert("Student already added to candidates list.");
					</script>
					<?php

				}

			}else{
				?>
				<script type="text/javascript">
					alert("No Student found with this Index Number...");
				</script>
				<?php
			}
		}else{
			?>
			<script type="text/javascript">
				alert("Sorry, make sure no field is empty!");
			</script>
			<?php
		}

	}else{
		?>
		<script type="text/javascript">
			alert("Sorry, make sure no field is empty!");
		</script>
		<?php
	}


}
?>




<?php include 'connections/close_config.php'; ?>
