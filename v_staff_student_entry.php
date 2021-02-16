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

if ($logedin_power!="sys_1" AND $logedin_power!="sys_3") {
	logout();
	die();
}


$staff_name = "";
$queryInfo = mysqli_query($conn, "SELECT * FROM staffs WHERE id='$logedin_id' AND active='yes'");
if (mysqli_num_rows($queryInfo)!==0) {

	$fetch =mysqli_fetch_assoc($queryInfo);
	$staff_name = $fetch["name"];
	$num_added_stdnts = $fetch["num_added_stdnts"];

}else{
	logout();
	die();
}


$secLevel = "";
if (isset($_SESSION["secLevel"])) {
	$secLevel = $_SESSION["secLevel"];
}

$secProgram = "";
if (isset($_SESSION["secProgram"])) {
	$secProgram = $_SESSION["secProgram"];

	$exp = explode(",", $secProgram);

	$program_name = "Unknown Campus";		
	$query_c = mysqli_query($conn, "SELECT * FROM programs WHERE id='".current($exp)."' AND active='yes'");
	if (mysqli_num_rows($query_c)!==0) {
		$program_name = mysqli_fetch_assoc($query_c)["name"];
	}

	$department_name = "Unknown Department";
	$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='".next($exp)."' AND active='yes'");
	if (mysqli_num_rows($query_d)!==0) {
		$department_name = mysqli_fetch_assoc($query_d)["name"];
	}

	$campus_name = "Unknown Campus";		
	$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='".next($exp)."' AND active='yes'");
	if (mysqli_num_rows($query_c)!==0) {
		$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
	}


	$secProgramName="$program_name ($department_name - $campus_name)";
}

$secStdType = "";
if (isset($_SESSION["secStdType"])) {
	$secStdType = $_SESSION["secStdType"];
}





$title = "Students Data";
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
				<li><span>DATA ENTRY</span></li>
				<li><span>Student Data</span></li>
			</ol>


		</div>

		<h2>Welcome <b><?php echo $staff_name  ?></b></h2>
	</header>

	<div class="row">
		<div class="col-lg-3">
			<form method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">Add Student Data</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">First Name: </label>
							<div class="col-sm-8">
								<input type="text" name="first_name" class="form-control" required>

							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">M. Name: </label>
							<div class="col-sm-8">
								<input type="text" name="sur_name" class="form-control">

							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Last Name: </label>
							<div class="col-sm-8">
								<input type="text" name="last_name" class="form-control" required>

							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Index No.: </label>
							<div class="col-sm-8">
								<input type="text" name="index_number" class="form-control" required>

							</div>
						</div>	

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Email Add.: </label>
							<div class="col-sm-8">
								<input type="email" name="stud_email" class="form-control" required>

							</div>

						</div>	

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Select Lvl: </label>
							<div class="col-sm-7">
								<select class="form-control" name="current_level" required>
									<?php 
									if ($secLevel=="") {
										?>
										<option disabled selected value="">Select Level</option>
										<?php
									}else{
										?>
										<option selected value="<?php echo $secLevel ?>"><?php echo $secLevel ?></option>
										<?php
									}
									?>
									<option value="Level 100">Level 100</option>
									<option value="Level 200">Level 200</option>
									<option value="Level 300">Level 300</option>
									<option value="Level 400">Level 400</option>
								</select>
								
							</div>

							<?php 
							if ($secLevel=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chkL" data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chkL" data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked="checked">
								<?php
							}
							?>
							
							
						</div>	

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Select Prg: </label>
							<div class="col-sm-7">
								<select class="form-control" name="program_department_campus"  required>
									<?php 
									$query_programs = mysqli_query($conn, "SELECT * FROM programs WHERE active='yes' ORDER BY name ASC");
									if (mysqli_num_rows($query_programs)!==0) {
										
										if ($secProgram=="") {
											?>
											<option disabled selected value="">Select Program, Campus and Department</option>
											<?php
										}else{
											?>
											<option selected value="<?php echo $secProgram ?>"><?php echo $secProgramName ?></option>
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
							<?php 
							if ($secProgram=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chkP"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-2" name="chkP"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked="checked">
								<?php
							}
							?>
							
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-1">Stdnt Type: </label>
							<div class="col-sm-7">
								<select class="form-control" name="create_student_type"  required>
									<?php 
									$query_std_type = mysqli_query($conn, "SELECT * FROM student_type WHERE active='yes' ORDER BY name ASC");
									if (mysqli_num_rows($query_std_type)!==0) {
										
										if ($secStdType=="") {
											?>
											<option disabled selected value="">Select Student Type</option>
											<?php
										}else{
											?>
											<option selected value="<?php echo $secStdType ?>"><?php echo $secStdType ?></option>
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
							<?php 
							if ($secStdType=="") {
								?>
								<input type="checkbox" class="col-sm-1 mt-1" name="chkSType"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection">
								<?php
							}else{
								?>
								<input type="checkbox" class="col-sm-1 mt-1" name="chkSType"  data-toggle="tooltip" data-placement="right" title="Check to lock current selection" checked="checked">
								<?php
							}
							?>
						</div>
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="createStudent">Submit </button>
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

					<h2 class="card-title">Added Student Data <span class="bg-primary text-white rounded p-1"> <?php echo $num_added_stdnts ?> </span></h2>
				</header>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<label class="h2">View By Department</label>
							
							<h3>
								<ul>
									<?php 
									$query_stud_departments = mysqli_query($conn, "SELECT DISTINCT department FROM students WHERE active='yes'");
									if (mysqli_num_rows($query_stud_departments)!==0) {
										while ($fetch=mysqli_fetch_assoc($query_stud_departments)) {
											$dep_id = $fetch["department"];

											$department_name = "Unknown Department";
											$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$dep_id' AND active='yes'");
											if (mysqli_num_rows($query_d)!==0) {
												$department_name = mysqli_fetch_assoc($query_d)["name"];
											}
											?>
											<li>
												<a href="0mdep<?php echo $dep_id ?>" target="_blank"><?php echo $department_name ?></a>
											</li>
											<?php
										}

									}else{
										echo  no_department_found_with("Department");
									}
									?>
								</ul>
							</h3>
						</div>
						<div class="col-sm-6">
							<label class="h2">View By Program</label>
							
							<h3>
								<ul>									
									<?php 
									$query_stud_departments = mysqli_query($conn, "SELECT DISTINCT program FROM students WHERE active='yes'");
									if (mysqli_num_rows($query_stud_departments)!==0) {
										while ($fetch=mysqli_fetch_assoc($query_stud_departments)) {
											$prog_id = $fetch["program"];

											$program="Unknown Program";
											$query_p = mysqli_query($conn, "SELECT * FROM programs WHERE id='$prog_id' AND active='yes'");
											if (mysqli_num_rows($query_p)!==0) {
												$program = mysqli_fetch_assoc($query_p)["name"];
											}
											?>
											<li>
												<a href="0mpro<?php echo $prog_id ?>" target="_blank"><?php echo $program ?></a>
											</li>
											<?php
										}

									}else{
										echo  no_department_found_with("Program");
									}
									?>
								</ul>
							</h3>
						</div>
						
						
					</div>
				</div>
			</section>
		</div>
	</div>
</section>
</div>



<?php include 'v_footer.php'; ?>

<script type="text/javascript">

	$(document).ready(function(){
		$('.student-data').addClass('nav-active');
		$('.data').addClass('nav-expanded nav-active');
	});
</script>






<?php 

if (isset($_POST["createStudent"])) {

	if ($logedin_power=="" || $logedin_id=="") {
		logout();
		die();
	}

	$chkL = strip_tags(htmlentities(stripslashes(@$_POST["chkL"])));
	$chkP = strip_tags(htmlentities(stripslashes(@$_POST["chkP"])));
	$chkSType = strip_tags(htmlentities(stripslashes(@$_POST["chkSType"])));


	$first_name = strip_tags(htmlentities(stripslashes($_POST["first_name"])));
	$sur_name = strip_tags(htmlentities(stripslashes($_POST["sur_name"])));
	$last_name = strip_tags(htmlentities(stripslashes($_POST["last_name"])));
	$index_number = strip_tags(htmlentities(stripslashes($_POST["index_number"])));
	$stud_email = strip_tags(htmlentities(stripslashes($_POST["stud_email"])));
	$program_department_campus = strip_tags(htmlentities(stripslashes($_POST["program_department_campus"])));
	$current_level = strip_tags(htmlentities(stripslashes($_POST["current_level"])));
	$create_student_type = strip_tags(htmlentities(stripslashes($_POST["create_student_type"])));


	$explode = explode(",", $program_department_campus);
	$program = strip_tags(stripslashes(htmlentities(current($explode))));
	$department = strip_tags(stripslashes(htmlentities(next($explode))));
	$campus = strip_tags(stripslashes(htmlentities(next($explode))));

	if (!empty($first_name) && !empty($last_name) && !empty($index_number) &&
		!empty($stud_email) &&  !empty($current_level) && !empty($program) && !empty($department) &&
		!empty($campus) && !empty($create_student_type) ) {

		if (is_numeric($program) && is_numeric($department) && is_numeric($campus)) {
			

			if ($chkL == true) {$_SESSION["secLevel"]=$current_level; }else{$_SESSION["secLevel"]=""; }
			if ($chkP == true) {$_SESSION["secProgram"]=$program_department_campus; }else{$_SESSION["secProgram"]=""; }
			if ($chkSType == true) {$_SESSION["secStdType"]=$create_student_type; }else{$_SESSION["secStdType"]=""; }


			$search_q = mysqli_query($conn, "SELECT * FROM students WHERE (index_number='$index_number' OR email = '$stud_email') AND active='yes'");
			if (mysqli_num_rows($search_q)===0) {
				
				mysqli_query($conn, "INSERT INTO students(firstname, surname, lastname, index_number, email, program, department, current_level, registered_level, campus, student_type,registered_by,registerer_power) VALUES('$first_name','$sur_name','$last_name','$index_number','$stud_email','$program','$department','$current_level','$current_level','$campus','$create_student_type',' $logedin_id','$logedin_power')");
				

				$num_added_stdnts+=1;
				mysqli_query($conn, "UPDATE staffs SET num_added_stdnts='$num_added_stdnts' WHERE id='$logedin_id' AND active='yes'");

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



?>

<?php include 'connections/close_config.php'; ?>