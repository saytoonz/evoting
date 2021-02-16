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



$title = "Admin Panel";
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
				<li><span>Campuses</span></li>
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

						<h2 class="card-title">Add Campus</h2>

					</header>
					<div class="card-body">
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Campus Name: </label>
							<div class="col-sm-8">
								<input type="text" name="newcampName" class="form-control" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-4 control-label text-sm-right pt-2">Campus Location: </label>
							<div class="col-sm-8">
								<input type="text" name="newcampLoc" class="form-control" required>
							</div>
						</div>
					</div>
					<footer class="card-footer text-right">
						<button class="btn btn-primary" name="createCampus">Submit </button>
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

					<h2 class="card-title">Added Campuses</h2>
				</header>
				<div class="card-body">
					

					<?php 

					$query_campus = mysqli_query($conn, "SELECT * FROM campuses WHERE active='yes' ORDER BY campus_name ASC");
					if (mysqli_num_rows($query_campus)!==0) {
						?>
						<table class="table table-bordered table-striped table-hover mb-0 table-responsive-lg">
							<thead>
								<tr>
									<th>Campus Name</th>
									<th>Location</th>
									<th>Action</th>

								</tr>
							</thead>

							<?php 
							while ($fetch_campus = mysqli_fetch_assoc($query_campus)) {
								$uid = $fetch_campus["id"];
								?>
								<tbody>
									<tr>
										<td><?php echo $fetch_campus["campus_name"]; ?></td>
										<td><?php echo $fetch_campus["campus_loc"]; ?></td>
										
										<td class="actions-hover actions-fade">
											<a href="#editCampus<?php echo $uid ?>" class="modal-with-form">
												<i class="fas fa-pencil-alt"></i>
											</a>
											<a href="#deleteBox<?php echo $uid ?>" class="modal-with-move-anim" class="delete-row"><i class="far fa-trash-alt"></i></a>
										</td>
									</tr>
								</tbody>

								<!-- --------------------------------- edit campus modal--------------------------------- -->

								<div id="editCampus<?php echo $uid ?>" class="zoom-anim-dialog modal-block  modal-header-color modal-block-info mfp-hide">
									<section class="card">
										<header class="card-header">
											<h2 class="card-title">Edit Campus Info</h2>
										</header>
										<form method="post" enctype="multipart/form-data">
											<div class="card-body">

												<div class="form-row">
													<div class="form-group col-md-6">
														<label>Campus Name</label>
														<input type="text" name="editcampName<?php echo $uid ?>" class="form-control" placeholder="Campus Name " value="<?php echo $fetch_campus["campus_name"];?>" required>
													</div>
													<div class="form-group col-md-6 mb-3 mb-lg-0">
														<label>Location</label>
														<input type="text" class="form-control" name="editcampLoc<?php echo $uid ?>" placeholder="Campus Location" value="<?php echo $fetch_campus["campus_loc"]; ?>" required>
													</div>
												</div>
											</div>
											<footer class="card-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-default modal-dismiss">Cancel</button>
														<button type="submit" name="editCampus<?php echo $uid ?>" class="btn btn-info">Update</button>
													</div>
												</div>
											</footer>
										</form>

										<!-- --------------------------------- end of edit campus modal --------------------------------- -->
										
										
										<!-- --------------------------------- delete campus modal --------------------------------- -->
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
																<p>Are sure you want to delete this campus completely? This action is not reversible.</p>
															</div>
														</div>
													</div>
													<footer class="card-footer">
														<div class="row">
															<div class="col-md-12 text-right">
																<button class="btn btn-default modal-dismiss">Cancel</button>
																<button class="btn btn-danger" name="deleteCampus<?php echo $uid ?>" type="submit">Yes! Delete!</button>

															</div>
														</div>
													</footer>
												</form>
											</section>
										</div>

										<!----------------------------------- end of delete campus modal --------------------------------- -->
									</section>
								</div>
								<?php

								if (isset($_POST["deleteCampus$uid"])) {
									
									if ($logedin_id=="" || $logedin_power!="sys_4") {
										logout();
										die();
									}
									mysqli_query($conn, "UPDATE campuses SET active='no' WHERE id='$uid' AND active='yes'");
									?><script type="text/javascript">location.replace("");</script><?php

								}




								if (isset($_POST["editCampus$uid"])) {
									
									if ($logedin_id=="" || $logedin_power!="sys_4") {
										logout();
										die();
									}

									$editcampName = strip_tags(htmlentities(stripslashes($_POST["editcampName$uid"])));
									$editcampLoc = strip_tags(htmlentities(stripslashes($_POST["editcampLoc$uid"])));

									if (!empty($editcampName) && !empty($editcampLoc)) {
										if (!empty($uid) && is_numeric($uid)) {
											mysqli_query($conn, "UPDATE campuses SET campus_name='$editcampName',campus_loc='$editcampLoc' WHERE id='$uid' AND active='yes'");
											?><script type="text/javascript">
												location.replace("");
												</script><?php
											}else{
												?>
												<script type="text/javascript">
													alert("Sorry, can't identify editing campus, refresh page and try again.");
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











									
								}
								?>

							</table>



							<?php
						}else{
							echo no_campus();
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
		$('.campus').addClass('nav-active');
		$('.management').addClass('nav-expanded nav-active');
	});
</script>






<?php 

if (isset($_POST["createCampus"])) {
	
	if ($logedin_id=="" || $logedin_power!="sys_4") {
		logout();
		die();
	}


	$newcampName = strip_tags(htmlentities(stripslashes($_POST["newcampName"])));
	$newcampLoc = strip_tags(htmlentities(stripslashes($_POST["newcampLoc"])));
	
	if (!empty($newcampLoc) && !empty($newcampName)) {
		mysqli_query($conn, "INSERT INTO campuses(campus_name,campus_loc) VALUES('$newcampName','$newcampLoc')");
		?><script type="text/javascript">location.replace("");</script><?php
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