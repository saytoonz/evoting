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



if (($logedin_power!="sys_4" && $logedin_power!="sys_3" && $logedin_power!="sys_1") || $logedin_id=="") {
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

if (isset($_GET["say"])) {
	$grab = $_GET["say"];
}else{
	$grab="";
}


if ($grab=="" || (strpos($grab, "mdep") === false AND strpos($grab, "mpro") ===false)) {
	die("<br><br><br><br>".contact_technicians()."<br><br><br><br>");
}


$class = substr($grab, 0,1);
if ($class==="0") {
	$class = "Level 100";
}elseif ($class==="1") {
	$class = "Level 200";
}elseif ($class==="2") {
	$class = "Level 300";
}elseif ($class==="3") {
	$class = "Level 400";
}else{
	die("<br><br><br><br>".contact_technicians()."<br><br><br><br>");
}


$link = substr($grab, 1);
$program_department_id = substr($link, 4);

$program_department = "Unknown";
$colomn ="";
if (strpos($grab,  "mdep")!==false) {
	$colomn = "department";
	$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$program_department_id' AND active='yes'");
	if (mysqli_num_rows($query_d)!==0) {
		$program_department = mysqli_fetch_assoc($query_d)["name"];
	}

}else if (strpos($grab,  "mpro")!==false) {
	$colomn = "program";
	$query_d = mysqli_query($conn, "SELECT * FROM programs WHERE id='$program_department_id' AND active='yes'");
	if (mysqli_num_rows($query_d)!==0) {
		$program_department = mysqli_fetch_assoc($query_d)["name"];
	}
}else{
	die("<br><br><br><br>".contact_technicians()."<br><br><br><br>");
}














$title = "View Full Data";
include 'v_header.php'; 
?>



<section role="main" class="content-body tab-menu-opened">
	<header class="page-header page-header-left-breadcrumb">
		<div class="right-wrapper">
			<ol class="breadcrumbs">
				<li>
					<a>
						<i class="fas fa-home"></i>
					</a>
				</li>
				<li><span>DATA VIEW</span></li>
				<li><span><?php echo strtoupper($colomn) ?></span></li>
				<li><span><?php echo strtoupper($program_department) ?></span></li>
				<li><span>Students</span></li>
			</ol>


		</div>

		<h2>
			<a href="0<?php echo $link ?>">Level 100</a> &nbsp; &nbsp; &nbsp; 
			<a href="1<?php echo $link ?>">Level 200</a> &nbsp; &nbsp; &nbsp; 
			<a href="2<?php echo $link ?>">Level 300</a> &nbsp; &nbsp; &nbsp; 
			<a href="3<?php echo $link ?>">Level 400</a>
		</h2>
	</header>

	<div class="row">


		<div class="col-lg-12">
			<section class="card">
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
					</div>

					<h2 class="card-title"><?php echo "$program_department <strong>$class</strong>"?> Student's Data</h2>
				</header>
				<div class="card-body">	<?php 
				$query_students = mysqli_query($conn, "SELECT * FROM students WHERE $colomn='$program_department_id' AND current_level='$class' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_students)===1) {?>
					<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
						<thead>
							<tr>
								<th>Full Name</th>
								<th>Index No.</th>
								<th>Email</th>
								<th>Type</th>
								<th>Campus</th>
								<th>Department</th>
								<th>Program</th>
								<th>Action</th>
								
							</tr>
						</thead>

						<?php 
						while ($get = mysqli_fetch_assoc($query_students)) {
							$stud_id = $get["id"];
							$firstname = $get["firstname"];
							$surname = $get["surname"];
							$lastname = $get["lastname"];
							$index_number = $get["index_number"];
							$email = $get["email"];
							$department_ = $get["department"];
							$program_ = $get["program"];
							$campus_ = $get["campus"];
							$student_type_ = $get["student_type"];
							$studLevel = $get["current_level"];


							$full_name = "$firstname $surname $lastname";

							$program_name = "Unknown";		
							$query_c = mysqli_query($conn, "SELECT * FROM programs WHERE id='$program_' AND active='yes'");
							if (mysqli_num_rows($query_c)!==0) {
								$program_name = mysqli_fetch_assoc($query_c)["name"];
							}

							$department_name = "Unknown";
							$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$department_' AND active='yes'");
							if (mysqli_num_rows($query_d)!==0) {
								$department_name = mysqli_fetch_assoc($query_d)["name"];
							}

							$campus_name = "Unknown";		
							$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_' AND active='yes'");
							if (mysqli_num_rows($query_c)!==0) {
								$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
							}
							

							?>

							<tbody>
								<tr>
									<td><?php echo $full_name ?></td>
									<td><?php echo $index_number ?></td>
									<td><?php echo $email ?></td>
									<td><?php echo $student_type_ ?></td>
									<td><?php echo $campus_name ?></td>
									<td><?php echo $department_name ?></td>
									<td><?php echo $program_name ?></td>



									<td class="actions-hover actions-fade">
										<a href="#editStudent<?php echo $stud_id ?>" class="modal-with-form"><i class="fas fa-pencil-alt"></i></a>
										<a href="#deleteBox<?php echo $stud_id ?>" class="modal-with-move-anim"><i class="far fa-trash-alt"></i></a>
									</td>


								</tr>
							</tbody>




							<!-- --------------------------------- edit Student modal ----------------------------------- -->
							<div id="editStudent<?php echo $stud_id ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-info mfp-hide">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Update Student Info</h2>
									</header>
									<form method="post" enctype="multipart/form-data">
										<div class="card-body">

											<div class="form-row">
												<div class="form-group col-md-4">
													<label >First Name</label>
													<input type="text" class="form-control" name="first_name<?php echo $stud_id ?>" placeholder="First Name" value="<?php echo $firstname ?>">
												</div>
												<div class="form-group col-md-4">
													<label>Middle Name</label>
													<input type="text" class="form-control" name="sur_name<?php echo $stud_id ?>" placeholder="Middle Name" value="<?php echo  $surname ?>">
												</div>
												<div class="form-group col-md-4 mb-3 mb-lg-0">
													<label>Last Name</label>
													<input type="text" class="form-control" name="last_name<?php echo $stud_id ?>" placeholder="Last Name" value="<?php echo  $lastname ?>">
												</div>
											</div>
											<div class="form-group">
												<label>Index Number</label>
												<input type="text" class="form-control" name="index_number<?php echo $stud_id ?>" value="<?php echo $index_number ?>"  placeholder="Index Number">
											</div>
											<div class="form-group">
												<label>Email Address</label>
												<input type="email" class="form-control" name="stud_email<?php echo $stud_id ?>" value="<?php echo  $email ?>" placeholder="Email Address">
											</div>
											<div class="form-group">

												<label>Program</label>
												<select  class="form-control" name="program_department_campus<?php echo $stud_id ?>">

													<?php 
													$query_programs = mysqli_query($conn, "SELECT * FROM programs WHERE active='yes' ORDER BY name ASC");
													if (mysqli_num_rows($query_programs)!==0) {

														if ($program_=="" || $department_=="" || $campus_=="") {
															?>
															<option disabled selected value="">Select Program, Campus and Department</option>
															<?php
														}else{


															?>
															<option value="<?php echo "$program_,$department_,$campus_" ?>"><?php echo "$program_name ($department_name - $campus_name)" ?></option>
															<?php
														}
														while ($fetch_departments = mysqli_fetch_assoc($query_programs)) {
															$prog_uid = $fetch_departments["id"];
															$program_name = $fetch_departments["name"];
															$department_id = $fetch_departments["department"];
															$campus_id = $fetch_departments["campus"];

															$campus_name = "Unknown Campus";
															$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus_id' AND active='yes'");
															if (mysqli_num_rows($query_c)!==0) {
																$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
															}

															$department_name = "Unknown Department";
															$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$department_id' AND active='yes'");
															if (mysqli_num_rows($query_d)!==0) {
																$department_name = mysqli_fetch_assoc($query_d)["name"];
															}
															?>
															<option value="<?php echo "$prog_uid,$department_id,$campus_id" ?>"><?php echo "$program_name ($department_name - $campus_name)" ?></option>
															<?php
														}
													}else{
														?>
														<option selected disabled value="">No Program found</option>
														<?php
													}
													?>
												</select>

											</div>
											<div class="form-group">
												<label>Current Class</label>
												<select  class="form-control" name="current_level<?php echo $stud_id ?>">
													<?php 
													if ($studLevel=="") {
														?>
														<option disabled selected value="">Select Level</option>
														<?php
													}else{
														?>
														<option selected value="<?php echo $studLevel ?>"><?php echo $studLevel ?></option>
														<?php
													}
													?>
													<option value="Level 100">Level 100</option>
													<option value="Level 200">Level 200</option>
													<option value="Level 300">Level 300</option>
													<option value="Level 400">Level 400</option>
												</select>

											</div>
											<div class="form-group">
												<label>Student type</label>
												<select class="form-control" name="create_student_type<?php echo $stud_id ?>"  required>
													<?php 
													$query_std_type = mysqli_query($conn, "SELECT * FROM student_type WHERE active='yes' ORDER BY name ASC");
													if (mysqli_num_rows($query_std_type)!==0) {

														if ($student_type_=="") {
															?>
															<option disabled selected value="">Select Student Type</option>
															<?php
														}else{
															?>
															<option selected value="<?php echo $student_type_ ?>"><?php echo $student_type_ ?></option>
															<?php
														}

														while ($fetch_studType = mysqli_fetch_assoc($query_std_type)) {
															$studType_uid = $fetch_studType["id"];
															$studType_name = $fetch_studType["name"];
															?>
															<option value="<?php echo "$studType_name" ?>"><?php echo "$studType_name" ?></option>
															<?php
														}
													}else{
														?>
														<option selected disabled value="">No Student Type found</option>
														<?php
													}
													?>
												</select>
											</div>
										</div>
										<footer class="card-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">Cancel</button>
													<button type="submit" class="btn btn-info" name="editStud<?php echo $stud_id ?>">Update</button>
												</div>
											</div>
										</footer>
									</form>


								</section>
							</div>
							<!-- ---------------------------------- end of edit Student modal ------------------------------------ -->



							<!-- ---------------------------------- delete Student modal ---------------------------------- -->
							<div id="deleteBox<?php echo $stud_id ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-danger mfp-hide">
								<section class="card">
									<header class="card-header">
										<h2 class="card-title">Delete Confirmation</h2>
									</header>
									<form method="post" enctype="multipart/form-data">
										<input type="hidden" name="delete" value="<?php echo 'id' ?>">
										<div class="card-body">
											<div class="modal-wrapper">
												<div class="modal-icon">
													<i class="fas fa-times-circle"></i>
												</div>
												<div class="modal-text">
													<h4>Irreversible Action</h4>
													<p>Are sure you want to delete this Student completely? This action is not reversible.</p>
												</div>
											</div>
										</div>
										<footer class="card-footer">
											<div class="row">
												<div class="col-md-12 text-right">
													<button class="btn btn-default modal-dismiss">Cancel</button>
													<button class="btn btn-danger" type="submit" name="delete_Student<?php echo $stud_id ?>">Yes! Delete!</button>

												</div>
											</div>
										</footer>
									</form>
								</section>
							</div>
							<!-- ---------------------------------- end of delete Student modal ---------------------------------- -->

							<?php

							if (isset($_POST["delete_Student$stud_id"])) {
								mysqli_query($conn, "UPDATE students SET active='no' WHERE id='$stud_id' AND active='yes'");
								?><script type="text/javascript">location.replace("");</script><?php

							}




							if (isset($_POST["editStud$stud_id"])) {
								if (($logedin_power!="sys_4" && $logedin_power!="sys_3" && $logedin_power!="sys_1") || $logedin_id=="") {
									logout();
									die();
								}

								$first_name = strip_tags(htmlentities(stripslashes($_POST["first_name$stud_id"])));
								$sur_name = strip_tags(htmlentities(stripslashes($_POST["sur_name$stud_id"])));
								$last_name = strip_tags(htmlentities(stripslashes($_POST["last_name$stud_id"])));
								$index_number = strip_tags(htmlentities(stripslashes($_POST["index_number$stud_id"])));
								$stud_email = strip_tags(htmlentities(stripslashes($_POST["stud_email$stud_id"])));
								$program_department_campus = strip_tags(htmlentities(stripslashes($_POST["program_department_campus$stud_id"])));
								$current_level = strip_tags(htmlentities(stripslashes($_POST["current_level$stud_id"])));
								$create_student_type = strip_tags(htmlentities(stripslashes($_POST["create_student_type$stud_id"])));

								$explode = explode(",", $program_department_campus);
								$program = strip_tags(stripslashes(htmlentities(current($explode))));
								$department = strip_tags(stripslashes(htmlentities(next($explode))));
								$campus = strip_tags(stripslashes(htmlentities(next($explode))));					


								if (!empty($first_name) &&  !empty($last_name) && !empty($index_number) &&
									!empty($stud_email) &&  !empty($current_level) && !empty($program) && !empty($department) &&
									!empty($campus) && !empty($create_student_type) ) {

									if (is_numeric($program) && is_numeric($department) && is_numeric($campus)) {

										$search_q = mysqli_query($conn, "SELECT * FROM students WHERE (index_number='$index_number' OR email = '$stud_email') AND id!='$stud_id' AND active='yes'");
										if (mysqli_num_rows($search_q)===0) {

											mysqli_query($conn, "UPDATE students SET firstname='$first_name', surname='$sur_name', lastname='$last_name', index_number='$index_number', email='$stud_email', program='$program', department='$department', current_level='$current_level', campus='$campus', student_type='$create_student_type' WHERE id='$stud_id' AND active='yes'");


											?>
											<script type="text/javascript">
												location.replace("");
											</script>
											<?php

										}else{
											?>
											<script type="text/javascript">
												alert("Index Number or Email exist already...");
											</script>
											<?php
										}



									}else{

										?>
										<script type="text/javascript">
											alert("Invalid program selected!!!");
										</script>
										<?php
									}


								}else{
									?>
									<script type="text/javascript">
										alert("Sorry, make sure All fields are filled!");
									</script>
									<?php
								}
							}
						}
						?>

					</table>
					<?php
				}else{
					echo no_student_($colomn);
				}

				?>


			</div>
		</section>
	</div>
</div>
</section>
</div>






<?php include 'v_footer.php'; ?>

<?php include 'connections/close_config.php'; ?>

