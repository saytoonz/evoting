
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





$title = "Student Types";
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
				<li><span>DATA ENTRY</span></li>
				<li><span>Student Type</span></li>
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

						<h2 class="card-title">Add Student Type</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Add Type: </label>
							<div class="col-sm-8">
								<input type="text" name="newStudType" class="form-control" required="required">

							</div>
						</div>
						
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="createStudentType">Submit </button>
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

					<h2 class="card-title">Added Student Types</h2>
				</header>
				<div class="card-body">
					<?php 

					$query_student_type = mysqli_query($conn, "SELECT * FROM student_type WHERE active='yes'");
					if (mysqli_num_rows($query_student_type)!==0) {
						?>
						<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
							<thead>
								<tr>
									<th>Student Type</th>
									<th>Action</th>
									
								</tr>
							</thead>

							<?php 
							while ($fetch_student_type = mysqli_fetch_assoc($query_student_type)) {
								$uid = $fetch_student_type["id"];
								$student_type_name = $fetch_student_type["name"];
								?>

								<tbody>
									<tr>
										<td><?php echo $student_type_name; ?></td>

										

										<td class="actions-hover actions-fade">
											<a href="#editType<?php echo $uid ?>" class="modal-with-form"><i class="fas fa-pencil-alt"></i></a>
											<a href="#deleteBox<?php echo $uid ?>" class="modal-with-move-anim"><i class="far fa-trash-alt"></i></a>
										</td>
										
									</tr>
								</tbody>






								<!-- --------------------------------- edit Student Type modal --------------------------------- -->
								<div id="editType<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-info mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Update Student Type Info</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<div class="card-body">

												<div class="form-row">
													<div class="form-group col-md-12">
														<label>Student Type Name</label>
														<input type="text" name="newStudType<?php echo $uid ?>" class="form-control" placeholder="Student Type Name " value="<?php echo $student_type_name; ?>">
													</div>
													
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button type="submit" class="btn btn-info" name="editStudentType<?php echo $uid ?>">Update</button>
													</div>
												</div>
											</footer>
										</form>
										
										
									</section>
								</div>
								<!-- --------------------------------- end of edit Student Type modal --------------------------------- -->

								<!-- --------------------------------- delete Student Type modal --------------------------------- -->
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
														<h4>Hello Friend!</h4>
														<p>Are sure you want to delete this Student Type completely? This action is not reversible.</p>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button class="btn btn-danger" type="submit" name="delete_student_type<?php echo $uid ?>">Yes! Delete!</button>

													</div>
												</div>
											</footer>
										</form>
									</section>
								</div>

								<!-- --------------------------------- end of delete Student Type modal --------------------------------- -->






								<?php

								if (isset($_POST["delete_student_type$uid"])) {
									mysqli_query($conn, "UPDATE student_type SET active='no' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}




								if (isset($_POST["editStudentType$uid"])) {
									
									if ($logedin_id=="" || !$logedin_power=="sys_4") {
										logout();
										die();
									}


									$name = strip_tags(htmlentities(stripslashes($_POST["newStudType$uid"])));


									if (!empty($name)) {
										$serch_q = mysqli_query($conn, "SELECT * FROM student_type WHERE name='$name' AND active='yes'");
										
										if (mysqli_num_rows($serch_q)===0) {													
											mysqli_query($conn, "UPDATE student_type SET name='$name' WHERE id='$uid' AND active='yes'");

											?><script type="text/javascript">location.replace("");</script><?php
										}else{
											?>
											<script type="text/javascript">
												alert("This student type already exist.");
											</script>
											<?php
										}
									}else{
										?>
										<script type="text/javascript">
											alert("Sorry, can't identify editing Student Type, refresh page and try again.");
										</script>
										<?php
									}
									
								}


								
							}
							?>

						</table>



						<?php
					}else{
						echo no_student_type();
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
		$('.student-type').addClass('nav-active');
		$('.data').addClass('nav-expanded nav-active');
	});
</script>



<?php 


if (isset($_POST["createStudentType"])) {
	
	if ($logedin_id=="" || !$logedin_power=="sys_4") {
		logout();
		die();
	}


	$name = strip_tags(htmlentities(stripslashes($_POST["newStudType"])));


	if (!empty($name)) {
		
		$serch_q = mysqli_query($conn, "SELECT * FROM student_type WHERE name='$name' AND active='yes'");
		
		if (mysqli_num_rows($serch_q)===0) {													
			mysqli_query($conn, "INSERT INTO student_type(name) VALUES('$name')");
			?><script type="text/javascript">location.replace("");</script><?php
		}else{
			?>
			<script type="text/javascript">
				alert("This student type already exist.");
			</script>
			<?php
		}
		
	}else{
		?>
		<script type="text/javascript">
			alert("Both Campus name and location are required.");
		</script>
		<?php
	}

}




?>

<?php include 'connections/close_config.php'; ?>