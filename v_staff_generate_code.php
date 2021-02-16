
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

if ($logedin_power!="sys_2" AND $logedin_power!="sys_3") {
	logout();
	die();
}


$admin_name = "";
$queryInfo = mysqli_query($conn, "SELECT * FROM staffs WHERE id='$logedin_id' AND active='yes'");
if (mysqli_num_rows($queryInfo)!==0) {

	$fetch =mysqli_fetch_assoc($queryInfo);
	$staff_name = $fetch["name"];
	$num_gen_codes = $fetch["num_gen_codes"];

}else{
	logout();
	die();
}

function generateRandomString($length = 5) {
	$characters = '123456789qwertyuioplkjhgfdsazxcvbnmZXCVBNMLKJHGFDSAQWERTYUIOP';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}



$title = "Staff Generate Codes";
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
				<li><span>CODE GENERATION</span></li>
				<li><span>Students</span></li>
			</ol>


		</div>

		<h2>Welcome <b><?php echo $staff_name ?></b></h2>
	</header>

	<div class="row">
		<div class="col-lg-4">
			<form method="post" enctype="multipart/form-data" class="form-horizontal">
				<section class="card">
					<header class="card-header">
						<div class="card-actions">
							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

						</div>

						<h2 class="card-title">Enter Student's Index Number</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Index No.: </label>
							<div class="col-sm-8">
								<input type="text" name="index_number" class="form-control" required>
							</div>
						</div>
						
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="submit">Generate</button>
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

					<h2 class="card-title">View Student's Data</h2>
				</header>
				<div class="card-body">

					<?php 

					if (isset($_POST["submit"])) {

						$index_number = strip_tags(stripslashes(htmlentities($_POST["index_number"])));

						if ($index_number!="") {

							$search_q = mysqli_query($conn, "SELECT * FROM students WHERE index_number='$index_number' AND active='yes' LIMIT 1");
							if (mysqli_num_rows($search_q)===1) {
								$get = mysqli_fetch_assoc($search_q);
								$stdnt_id = $get["id"];
								$firstname = $get["firstname"];
								$surname = $get["surname"];
								$lastname = $get["lastname"];
								$department = $get["department"];
								$program = $get["program"];
								$campus = $get["campus"];
								$current_level = $get["current_level"];


								$department_name="Unknown";
								$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$department' AND active='yes'");
								if (mysqli_num_rows($query_d)!==0) {
									$department_name = mysqli_fetch_assoc($query_d)["name"];
								}

								$program_name="Unknown";
								$query_p = mysqli_query($conn, "SELECT * FROM programs WHERE id='$program' AND active='yes'");
								if (mysqli_num_rows($query_p)!==0) {
									$program_name = mysqli_fetch_assoc($query_p)["name"];
								}

								$campus_name = "Unknown";
								$query_c = mysqli_query($conn, "SELECT * FROM campuses WHERE id='$campus' AND active='yes'");
								if (mysqli_num_rows($query_c)!==0) {
									$campus_name = mysqli_fetch_assoc($query_c)["campus_name"];
								}



								$query = mysqli_query($conn, "SELECT * FROM accesses WHERE student_id='$stdnt_id' AND active='yes' LIMIT 1");
								if (mysqli_num_rows($query)===1) {
									$grab = mysqli_fetch_assoc($query);

									$acc_id = $grab["id"];
									$two_access = $grab["two_access"];
									$voted = $grab["voted"];


									$newAccess = generateRandomString(5);
									$token = $two_access;

									if ($two_access=="" AND $voted=="no") {
										mysqli_query($conn, "UPDATE accesses SET two_access='$newAccess',two_acc_time = now(), two_acc_gen_by='$logedin_id', two_acc_generator_priority='$logedin_power' WHERE id='$acc_id'");

										$num_gen_codes+=1;
										mysqli_query($conn, "UPDATE staffs SET num_gen_codes='$num_gen_codes' WHERE id='$logedin_id' AND active='yes'");

										$token = $newAccess;
									}

									?>
									<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
										<thead>
											<tr>
												<th>Student's Name</th>
												<th>Access Code </th>
												<th>Campus</th>
												<th>Department</th>
												<th>Program</th>
												<th>Level</th>
												<th>Status</th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td><?php echo "$surname $lastname $firstname" ?></td>
												<td><?php echo $token ?></td>
												<td><?php echo $campus_name ?></td>
												<td><?php echo $department_name ?></td>
												<td><?php echo $program_name ?></td>
												<td><?php echo $current_level ?></td>
												<td>
													<?php if ($voted=="no"): ?>
														<a class="btn btn-success text-white  text-bold">not voted</a>
													<?php endif ?>

													<?php if ($voted=="yes"): ?>
														<a class="btn btn-danger text-white  text-bold">voted</a>
													<?php endif ?>
													
													
												</td>
											</tr>


										</tbody>
									</table>

									<?php

								}else{
									echo student_not_found();
								}

							}else{
								echo no_student_found();
							}

						}else{
							echo type_to_search();
						}
					}else{
						echo no_access_code_generated();
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
		$('.acess-code-staff').addClass('nav-expanded nav-active');
	});
</script>

<?php include 'connections/close_config.php'; ?>