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



 if ($logedin_power!="sys_0" || $logedin_id=="" || $access_id=="") {
 	logout();
 	die();
 }

 $student_name = "";
 $student_department = "Unknown Department";
 $student_index = "";
 $dep_id = "";
 $stud_campus__id = "";
 $queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$logedin_id' AND active='yes'");
 if (mysqli_num_rows($queryInfo)!==0) {

 	$fetch =mysqli_fetch_assoc($queryInfo);
 	$firstname = $fetch["firstname"];
 	$surname = $fetch["surname"];
 	$lastname = $fetch["lastname"];
 	$dep_id = $fetch["department"];
 	$stud_campus__id = $fetch["campus"];

 	$student_index = $fetch["index_number"];
 	$student_name = "$firstname $surname $lastname";


 	$query_d = mysqli_query($conn, "SELECT * FROM departments WHERE id='$dep_id' AND active='yes'");
 	if (mysqli_num_rows($query_d)!==0) {
 		$student_department = mysqli_fetch_assoc($query_d)["name"];
 	}
 }else{
 	logout();
 	die();
 }


 $title = "Voting Department";
 include 'v_header.php'; 
 
 ?>





 <?php include 'v_sidebar.php'; ?>
 
 <section role="main" class="content-body tab-menu-opened">
 	<header class="page-header page-header-left-breadcrumb">
 		<div class="right-wrapper">
 			<ol class="breadcrumbs">
 				<li>
 					<a href="home">
 						<i class="fas fa-home"></i>
 					</a>
 				</li>
 				<li><span>DEPARTMENT</span></li>
 				<li><span>Departmental Nominees</span></li>
 			</ol>


 		</div>

 		<h2>Welcome <b><?php echo $student_name ?></b> of <b><?php echo $student_department ?> </b> with index number <b><?php echo $student_index ?></b></h2>
 	</header>


 	<?php 


 	$query_vote = mysqli_query($conn, "SELECT voted,has_voted_which FROM accesses WHERE id = '$access_id' AND active='yes' LIMIT 1");
 	$get = mysqli_fetch_assoc($query_vote);
 	$voted = $get["voted"];
 	$has_voted_which = $get["has_voted_which"];
 	if ($has_voted_which=="department"  || $has_voted_which=="all" || $voted=="all") {
 		echo(has_voted_for_section());
 	}else{

 		?>


 		<div class="row">
 			<div class="col">
 				<section class="card form-wizard" id="w4">
 					<header class="card-header">
 						<div class="card-actions">
 							<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 						</div>

 						<h2 class="card-title">Departmental Voting</h2>
 					</header>
 					<div class="card-body">
 						<div class="wizard-progress wizard-progress-lg">
 							<div class="steps-progress">
 								<div class="progress-indicator"></div>
 							</div>
 							<ul class="nav wizard-steps">
 								<li class="nav-item active">
 									<a class="nav-link" href="#w4-president" data-toggle="tab"><span>1</span>President</a>
 								</li>
 								<li class="nav-item">
 									<a class="nav-link" href="#w4-secretary" data-toggle="tab"><span>2</span>Secretary</a>
 								</li>
 								<li class="nav-item">
 									<a class="nav-link" href="#w4-finance" data-toggle="tab"><span>3</span>Financial Secretary</a>
 								</li>
 								<li class="nav-item">
 									<a class="nav-link" href="#w4-organizer" data-toggle="tab"><span>4</span>Organizer</a>
 								</li>
 								<li class="nav-item">
 									<a class="nav-link" href="#w4-pro" data-toggle="tab"><span>5</span>Public Relations Officer</a>
 								</li>
 								<li class="nav-item">
 									<a class="nav-link" href="#w4-mp" data-toggle="tab"><span>6	</span>Member of Parliament</a>
 								</li>
 							</ul>
 						</div>

 						<div class="tab-content">
 							<div id="w4-president" class="tab-pane  active">
 								<form>

 									<li class="list-unstyled president"> <span class="h4 custom-radio p-2 ml-2">
 										<img src="img/!logged-user.jpg" class="d-none" />
 										<input type="radio" name="selected" value="novote" id="president$idf" class="custom-control-input" />
 										<p class="custom-control-label" for="president$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 									</span>
 								</li>




 								<ul class="list-unstyled search-results-list col">



 									<?php 

 									$i = 1;

 									$prez_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='President' AND active='yes'");
 									if (mysqli_num_rows($prez_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($prez_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$prez_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$prez_name = "$firstname $surname $lastname";
 											}else{
 												$prez_name = "";
 											}

 											?>
 											<!-- candidates in a while loop for src president -->

 											<li class="president">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\"  alt=\"$prez_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$prez_name\" />";
 													}
 													?>

 													<p class="h4 pull-right text-primary"><?php echo $prez_name ?></p>

 													<div class="custom-radio pull-right mt-2">
 														<input type="radio" id="president<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="president<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>


 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("Presidency");
 									}

 									?>
 									<!-- end of candidates in a while loop for src president -->

 								</ul>

 							</form>
 						</div>
 						<div id="w4-mp" class="tab-pane ">

 							<form>
 								<li class=" list-unstyled mp"> <span class="h4 custom-radio ml-2 p-2">
 									<img src="img/!logged-user.jpg" class="d-none" />
 									<input type="radio" name="selected" value="novote" id="mp$idf" class="custom-control-input" />
 									<p class="custom-control-label" for="mp$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 								</span></li>




 								<ul class="list-unstyled search-results-list col">
 									<?php 

 									$i = 1;

 									$mp_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='Member of Parliament' AND active='yes'");
 									if (mysqli_num_rows($mp_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($mp_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$mp_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$mp_name = "$firstname $surname $lastname";
 											}else{
 												$mp_name = "";
 											}

 											?>


 											<li class="mp">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$mp_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$mp_name\" />";
 													}
 													?>

 													<p class="h4 text-primary pull-right"><?php echo $mp_name ?></p>

 													<div class="custom-radio pull-right mt-2">
 														<input type="radio" id="mp<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="mp<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>

 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("MP");
 									}

 									?>
 								</ul>

 							</form>
 						</div>

 						<div id="w4-secretary" class="tab-pane ">
 							<form>
 								<li class=" list-unstyled secretary"> <span class="h4 custom-radio ml-2 p-2">
 									<img src="img/!logged-user.jpg" class="d-none" />
 									<input type="radio" name="selected" value="novote" id="secretary$idf" class="custom-control-input" />
 									<p class="custom-control-label" for="secretary$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 								</span></li>



 								<ul class="list-unstyled search-results-list col">
 									<?php 

 									$i = 1;

 									$sec_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='Secretary' AND active='yes'");
 									if (mysqli_num_rows($sec_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($sec_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$sec_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$sec_name = "$firstname $surname $lastname";
 											}else{
 												$sec_name = "";
 											}

 											?>

 											<li class="secretary">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\"  alt=\"$sec_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$sec_name\" />";
 													}
 													?>
 													<p class="h4 text-primary pull-right"><?php echo $sec_name ?></p>

 													<div class="custom-radio pull-right mt-2">
 														<input type="radio" id="secretary<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="secretary<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>

 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("Secretary");
 									}

 									?>
 								</ul>

 							</form>
 						</div>
 						<div id="w4-finance" class="tab-pane ">
 							<form>

 								<li class=" list-unstyled finance"> <span class="h4 custom-radio p-2 ml-2">
 									<img src="img/!logged-user.jpg" class="d-none" />
 									<input type="radio" name="selected" value="novote" id="finance$idf" class="custom-control-input" />
 									<p class="custom-control-label" for="finance$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 								</span></li>



 								<ul class="list-unstyled search-results-list col">
 									<?php 

 									$i = 1;

 									$finanacial_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='Financial Secretary' AND active='yes'");
 									if (mysqli_num_rows($finanacial_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($finanacial_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$finanacial_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$finanacial_name = "$firstname $surname $lastname";
 											}else{
 												$finanacial_name = "";
 											}

 											?>

 											<li class="finance">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$finanacial_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$finanacial_name\" />";
 													}
 													?>


 													<p class="h4 text-primary pull-right"><?php echo $finanacial_name ?></p>

 													<div class="custom-radio pull-right mt-2">
 														<input type="radio" id="fsecretary<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="fsecretary<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>

 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("Financial Secretary");
 									}

 									?>
 								</ul>

 							</form>
 						</div>
 						<div id="w4-organizer" class="tab-pane  ">
 							<form>
 								<li class=" list-unstyled organizer"> <span class="custom-radio p-2 ml-2 h4">
 									<img src="img/!logged-user.jpg" class="d-none" />
 									<input type="radio" name="selected" value="novote" id="organizer$idf" class="custom-control-input" />
 									<p class="custom-control-label" for="organizer$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 								</span></li>




 								<ul class="list-unstyled search-results-list col">
 									<?php 

 									$i = 1;

 									$organa_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='General Organizer' AND active='yes'");
 									if (mysqli_num_rows($organa_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($organa_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$organa_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$organa_name = "$firstname $surname $lastname";
 											}else{
 												$organa_name = "";
 											}

 											?>

 											<li class="organizer">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$organa_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$organa_name\" />";
 													}
 													?>

 													<p class="h4 text-primary pull-right"><?php echo $organa_name ?></p>

 													<div class="custom-radio float-right mt-2">
 														<input type="radio" id="organizer<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="organizer<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>
 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("General Organizer");
 									}

 									?>
 								</ul>

 							</form>
 						</div>
 						<div id="w4-pro" class="tab-pane  ">

 							<form>
 								<li class=" list-unstyled pro"> <span class="custom-radio ml-2 p-2 h4">
 									<img src="img/!logged-user.jpg" class="d-none" />
 									<input type="radio" name="selected" value="novote" id="pro$idf" class="custom-control-input" />
 									<p class="custom-control-label" for="pro$idf" style="cursor: pointer;background-color: #e9ecef;">No vote</p>
 								</span></li>




 								<ul class="list-unstyled search-results-list col">
 									<?php 

 									$i = 1;

 									$pro_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='Department' AND department_if='$dep_id' AND campus='$stud_campus__id' AND designation='Public Relations Officer(P.R.O)' AND active='yes'");
 									if (mysqli_num_rows($pro_query)!==0) {
 										while ($ft_prez = mysqli_fetch_assoc($pro_query)) {
 											$cand_id = $ft_prez["id"];
 											$student_id = $ft_prez["student_id"];
 											$image = $ft_prez["image"];

 											$p_r_o_name = "";
 											$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 											if (mysqli_num_rows($queryInfo)!==0) {

 												$fetch =mysqli_fetch_assoc($queryInfo);
 												$firstname = $fetch["firstname"];
 												$surname = $fetch["surname"];
 												$lastname = $fetch["lastname"];

 												$p_r_o_name = "$firstname $surname $lastname";
 											}else{
 												$p_r_o_name = "";
 											}

 											?>
 											<li class="pro">

 												<a href="javascript:void(0);" class="has-thumb">
 													<div class="result-thumb h4 title text-primary">
 														<?php echo $i ?>
 													</div>

 													<?php 
 													if ($image=="") {
 														echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$p_r_o_name\" />";
 													}else{
 														echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" width=\"100\" height=\"100\" alt=\"$p_r_o_name\" />";
 													}
 													?>
 													<p class="h4 text-primary pull-right"><?php echo $p_r_o_name ?></p>

 													<div class="custom-radio pull-right mt-2">
 														<input type="radio" id="pro<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 														<label class="custom-control-label" for="pro<?php echo $cand_id ?>"></label>
 													</div>
 												</a>

 											</li>
 											<?php


 											$i++;

 										}
 									}else{
 										echo no_candidate_found_for_added("P.R.O");
 									}

 									?>
 								</ul>

 							</form>
 						</div>

 					</div>
 				</div>
 				<div class="card-footer">
 					<ul class="pager">
 						<li class="previous disabled">
 							<a><i class="fas fa-angle-left"></i> Previous</a>
 						</li>
 						<li class="finish hidden float-right ">
 							<a href="#confirmVote" class="prevAll">Submit Vote</a>
 						</li>
 						<li class="next">
 							<a>Next <i class="fas fa-angle-right"></i></a>
 						</li>
 					</ul>
 				</div>
 			</section>
 		</div>
 	</div>



 	<div class="col-lg-12">
 		<a href="#confirmVote" class="mb-1 mt-1 mr-1 btn btn-primary btn-lg pull-right modal-with-move-anim ws-normal" id="prevAll">Submit Vote</a>
 	</div>

 </section>
</div>

<div id="confirmVote" class="zoom-anim-dialog modal-block modal-lg modal-block-info mfp-hide">
	<section class="card">
		<header class="card-header">
			<h2 class="card-title">Confirm Departmental Voting</h2>
		</header>
		<form method="post" enctype="multipart/form-data">

			<div class="card-body">
				<div class="row">
					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid presImg" width="50" height="50">
									</figure>
									<span class="title text-center presName"></span>
									<input type="hidden" name="president_id" class="presID">
									<span class="message truncate text-center">President</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid secImg" width="50" height="50">
									</figure>
									<span class="title text-center secName"></span>
									<input type="hidden" name="secretary_id" class="secID">
									<span class="message truncate text-center">Secretary</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid finImg" width="50" height="50">
									</figure>
									<span class="title text-center finName"></span>
									<input type="hidden" name="finance_id" class="finID">
									<span class="message truncate text-center">Financial Secretary</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid proImg" width="50" height="50">
									</figure>
									<span class="title text-center proName"></span>
									<input type="hidden" name="pro_id" class="proID">
									<span class="message truncate text-center">PRO</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid orgImg" width="50" height="50">
									</figure>
									<span class="title text-center orgName"></span>
									<input type="hidden" name="org_id" class="orgID">
									<span class="message truncate text-center">Organizer</span>
								</li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4">
						<div class="content">
							<ul class="simple-user-list">
								<li>
									<figure class="image rounded">
										<img src="" alt="" class="rounded img-fluid mpImg" width="50" height="50">
									</figure>
									<span class="title text-center mpName"></span>
									<input type="hidden" name="mp_id" class="mpID">
									<span class="message truncate text-center">MP</span>
								</li>
							</ul>
						</div>
					</div>



				</div>
			</div>
			<footer class="card-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<button class="btn btn-default modal-dismiss">Cancel</button>
						<button class="btn btn-info" name="conc_vote">Confirm Voting</button>
					</div>
				</div>
			</footer>
		</form>

	</section>
</div>



<?php 
}
?>
<?php include 'v_footer.php'; ?>

<script type="text/javascript">

	function preview() {
		var presImg = $('.presimg').attr('src');
		$('.prevPresImg').attr('src', presImg);

		var presName = $('.presn').text();
		$('.newName').html(presName);
	}



	$(document).ready(function(){
		$('.department-vote').addClass('nav-expanded nav-active');

		$('.president').on('click',function(){
			$('.president').find('input').removeAttr('checked');
			$('li.president').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});

		$('.secretary').on('click',function(){
			$('.secretary').find('input').removeAttr('checked');
			$('li.secretary').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});

		$('.finance').on('click',function(){
			$('.finance').find('input').removeAttr('checked');
			$('li.finance').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});
		$('.pro').on('click',function(){
			$('.pro').find('input').removeAttr('checked');
			$('li.pro').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});

		$('.mp').on('click',function(){
			$('.mp').find('input').removeAttr('checked');
			$('li.mp').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});

		$('.organizer').on('click',function(){
			$('.organizer').find('input').removeAttr('checked');
			$('li.organizer').removeClass('active');
			$(this).addClass('active');
			$(this).find('input').attr('checked','checked');

		});




		$('#prevAll').click(function(){

			var pTag = $('li.president.active');
			var president_name = pTag.find('p').text();
			var president_id = pTag.find('input:radio').val();
			var president_image = pTag.find('img').attr('src');

			$('.presName').html(president_name);
			$('.presImg').attr('src', president_image);
			$('.presID').val(president_id);

			var sTag = $('li.secretary.active');
			var secretary_name = sTag.find('p').text();
			var secretary_id = sTag.find('input:radio').val();
			var secretary_image = sTag.find('img').attr('src');

			$('.secName').html(secretary_name);
			$('.secImg').attr('src', secretary_image);
			$('.secID').val(secretary_id);

			var fTag = $('li.finance.active');
			var finance_name = fTag.find('p').text();
			var finance_id = fTag.find('input:radio').val();
			var finance_image = fTag.find('img').attr('src');

			$('.finName').html(finance_name);
			$('.finImg').attr('src', finance_image);
			$('.finID').val(finance_id);

			var prTag = $('li.pro.active');
			var pro_name = prTag.find('p').text();
			var pro_id = prTag.find('input:radio').val();
			var pro_image = prTag.find('img').attr('src');

			$('.proName').html(pro_name);
			$('.proImg').attr('src', pro_image);
			$('.proID').val(pro_id);

			var oTag = $('li.organizer.active');
			var organizer_name = oTag.find('p').text();
			var organizer_id = oTag.find('input:radio').val();
			var organizer_image = oTag.find('img').attr('src');

			$('.orgName').html(organizer_name);
			$('.orgImg').attr('src', organizer_image);
			$('.orgID').val(organizer_id);

			var mTag = $('li.mp.active');
			var mp_name = mTag.find('p').text();
			var mp_id = mTag.find('input:radio').val();
			var mp_image = mTag.find('img').attr('src');

			$('.mpName').html(mp_name);
			$('.mpImg').attr('src', mp_image);
			$('.mpID').val(mp_id);

		});

	});

	(function($) {

		'use strict';
		var $w4finish = $('#w4').find('ul.pager li.finish');
		
		$('#w4').bootstrapWizard({
			tabClass: 'wizard-steps',
			nextSelector: 'ul.pager li.next',
			previousSelector: 'ul.pager li.previous',
			firstSelector: null,
			lastSelector: null,
			onTabClick: function( tab, navigation, index, newindex ) {
				if ( newindex == index + 1 ) {
					return this.onNext( tab, navigation, index, newindex);
				} else if ( newindex > index + 1 ) {
					return false;
				} else {
					return true;
				}
			},
			onTabChange: function( tab, navigation, index, newindex ) {
				var $total = navigation.find('li').length - 1;
				$w4finish[ newindex != $total ? 'addClass' : 'removeClass' ]( 'hidden' );
				$('#w4').find(this.nextSelector)[ newindex == $total ? 'addClass' : 'removeClass' ]( 'hidden' );
			},
			onTabShow: function( tab, navigation, index ) {
				var $total = navigation.find('li').length - 1;
				var $current = index;
				var $percent = Math.floor(( $current / $total ) * 100);

				navigation.find('li').removeClass('active');
				navigation.find('li').eq( $current ).addClass('active');

				$('#w4').find('.progress-indicator').css({ 'width': $percent + '%' });
				tab.prevAll().addClass('completed');
				tab.nextAll().removeClass('completed');
			}
		});
	}).apply(this, [jQuery]);

</script>





<?php 

if (isset($_POST["conc_vote"])) {
	$president_id = strip_tags(stripslashes(htmlentities($_POST["president_id"])));
	$secretary_id = strip_tags(stripslashes(htmlentities($_POST["secretary_id"])));
	$finance_id = strip_tags(stripslashes(htmlentities($_POST["finance_id"])));
	$org_id = strip_tags(stripslashes(htmlentities($_POST["org_id"])));
	$pro_id = strip_tags(stripslashes(htmlentities($_POST["pro_id"])));
	$mp_id = strip_tags(stripslashes(htmlentities($_POST["mp_id"])));

	if ($president_id=="") {$president_id = "novote"; }
	if ($secretary_id=="") {$secretary_id = "novote"; }
	if ($finance_id=="") {$finance_id = "novote"; }
	if ($org_id=="") {$org_id = "novote"; }
	if ($pro_id=="") {$pro_id = "novote"; }
	if ($mp_id=="") {$mp_id = "novote"; }






	$departmental_prez_gs_fs_org_pro_mp = "$president_id,$secretary_id,$finance_id,$org_id,$pro_id,$mp_id";

	if ($president_id!="" && $secretary_id!="" && $finance_id!="" && $pro_id!="" && $org_id!="" && $mp_id!="") {

		$already_voted_for = "";
		$query_vote = mysqli_query($conn, "SELECT departmental_prez_gs_fs_org_pro_mp FROM votes WHERE index_number='$student_index' AND active='yes' LIMIT 1");
		if (mysqli_num_rows($query_vote)===1) {
			$already_voted_for = mysqli_fetch_assoc($query_vote) ["departmental_prez_gs_fs_org_pro_mp"];
			mysqli_query($conn,"UPDATE votes SET departmental_prez_gs_fs_org_pro_mp='$departmental_prez_gs_fs_org_pro_mp' WHERE index_number = '$student_index' AND active='yes'");

		}else{
			mysqli_query($conn, "INSERT INTO votes(index_number,departmental_prez_gs_fs_org_pro_mp) VALUES('$student_index','$departmental_prez_gs_fs_org_pro_mp')");
		}



		if ($already_voted_for!="" AND $already_voted_for!==$departmental_prez_gs_fs_org_pro_mp) {

			$exp_old = explode(",", $already_voted_for);
			$prez_old = current($exp_old);
			$gs_old = next($exp_old);
			$fs_old = next($exp_old);
			$org_old = next($exp_old);
			$pro_old = next($exp_old);
			$mp_old = end($exp_old);

			$exp_new = explode(",", $departmental_prez_gs_fs_org_pro_mp);
			$prez_new = current($exp_new);
			$gs_new = next($exp_new);
			$fs_new = next($exp_new);
			$org_new = next($exp_new);
			$pro_new = next($exp_new);
			$mp_new = end($exp_new);

			if ($prez_new !== $prez_old) {

				if ($prez_new!="" AND $prez_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$prez_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$prez_new' AND active='yes'");

					}
				}

				if ($prez_old!="" AND $prez_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$prez_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$prez_old' AND active='yes'");

					}
				}
			}





			if ($gs_old !== $gs_new) {

				if ($gs_new!="" AND $gs_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$gs_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$gs_new' AND active='yes'");

					}
				}

				if ($gs_old!="" AND $gs_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$gs_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$gs_old' AND active='yes'");

					}
				}
			}






			if ($fs_old !== $fs_new) {

				if ($fs_new!="" AND $fs_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$fs_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$fs_new' AND active='yes'");

					}
				}

				if ($fs_old!="" AND $fs_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$fs_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$fs_old' AND active='yes'");

					}
				}
			}






			if ($org_old !== $org_new) {

				if ($org_new!="" AND $org_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$org_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$org_new' AND active='yes'");

					}
				}

				if ($org_old!="" AND $org_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$org_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$org_old' AND active='yes'");

					}
				}
			}







			if ($pro_old !== $pro_new) {

				if ($pro_new!="" AND $pro_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$pro_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$pro_new' AND active='yes'");

					}
				}

				if ($pro_old!="" AND $pro_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$pro_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$pro_old' AND active='yes'");

					}
				}
			}






			if ($mp_old !== $mp_new) {

				if ($mp_new!="" AND $mp_new!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$mp_new' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes+1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$mp_new' AND active='yes'");

					}
				}

				if ($mp_old!="" AND $mp_old!="novote") {
					$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$mp_old' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_contestants)===1) {
						$fetch = mysqli_fetch_assoc($query_contestants);
						$votes = $fetch["votes"];
						$newVote = $votes-1;
						if ($newVote<=0) {
							$newVote="0";
						}

						mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$mp_old' AND active='yes'");

					}
				}
			}





			

		}else{








			if ($president_id!="" AND $president_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$president_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$president_id' AND active='yes'");



					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='President' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='President' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','President','1')");
					}

				}
			}








			if ($secretary_id!="" AND $secretary_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$secretary_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$secretary_id' AND active='yes'");


					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='Secretary' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='Secretary' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','Secretary','1')");
					}

				}
			}









			if ($finance_id!="" AND $finance_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$finance_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$finance_id' AND active='yes'");


					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='Financial Secretary' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='Financial Secretary' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','Financial Secretary','1')");
					}
				}
			}








			if ($pro_id!="" AND $pro_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$pro_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$pro_id' AND active='yes'");


					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='Public Relations Officer(P.R.O)' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='Public Relations Officer(P.R.O)' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','Public Relations Officer(P.R.O)','1')");
					}
				}
			}








			if ($org_id!="" AND $org_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$org_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$org_id' AND active='yes'");


					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='General Organizer' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='General Organizer' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','General Organizer','1')");
					}
				}
			}







			if ($mp_id!="" AND $mp_id!="novote") {
				$query_contestants = mysqli_query($conn, "SELECT * FROM contestants WHERE cand_id='$mp_id' AND active='yes' LIMIT 1");
				if (mysqli_num_rows($query_contestants)===1) {
					$fetch = mysqli_fetch_assoc($query_contestants);
					$votes = $fetch["votes"];
					$newVote = $votes+1;
					if ($newVote<=0) {
						$newVote="0";
					}

					mysqli_query($conn,"UPDATE contestants SET votes='$newVote' WHERE  cand_id='$mp_id' AND active='yes'");


					$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='Department' AND designation='Member of Parliament' AND active='yes' LIMIT 1");
					if (mysqli_num_rows($query_total_votes)===1) {
						$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
						$updated_voter = $total_voters+1;
						mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='Department' AND designation='Member of Parliament' AND active='yes'");

					}else{
						mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('Department','Member of Parliament','1')");
					}
				}
			}





		}









		$query_vote = mysqli_query($conn, "SELECT has_voted_which FROM accesses WHERE id = '$access_id' AND active='yes' LIMIT 1");
		$has_voted_which = mysqli_fetch_assoc($query_vote) ["has_voted_which"];
		if ($has_voted_which=="none") {
			mysqli_query($conn,"UPDATE accesses SET has_voted_which='department' WHERE id = '$access_id' AND active='yes'");

		}else{
			mysqli_query($conn,"UPDATE accesses SET has_voted_which='all', voted='yes' WHERE id = '$access_id' AND active='yes'");

			?>
			<script type="text/javascript">
				alert("You have casted all votes Successfully");
			</script>
			<?php

			logout();
		}

		?>
		<script type="text/javascript">
			location.replace("home");
		</script>
		<?php

	}else{

		?>
		<script type="text/javascript">
			alert("Unrecognized error, refresh page and try again.");
		</script>
		<?php
	}

}



?>



<?php include 'connections/close_config.php'; ?>