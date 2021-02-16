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
 $dep_id="";
 $queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$logedin_id' AND active='yes'");
 if (mysqli_num_rows($queryInfo)!==0) {

 	$fetch =mysqli_fetch_assoc($queryInfo);
 	$firstname = $fetch["firstname"];
 	$surname = $fetch["surname"];
 	$lastname = $fetch["lastname"];
 	$dep_id = $fetch["department"];

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
 $title = "Voting";
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
 				<li><span>SRC</span></li>
 				<li><span>Presidential Nominees</span></li>
 			</ol>


 		</div>

 		<h2>
 			Welcome <b><?php echo $student_name ?> </b> 
 			of <b><?php echo $student_department ?> </b> 
 			with index number <b><?php echo $student_index ?></b>
 		</h2>
 	</header>

 	<?php 


 	$query_vote = mysqli_query($conn, "SELECT voted,has_voted_which FROM accesses WHERE id = '$access_id' AND active='yes' LIMIT 1");
 	$get = mysqli_fetch_assoc($query_vote);
 	$voted = $get["voted"];
 	$has_voted_which = $get["has_voted_which"];
 	if ($has_voted_which=="src" || $has_voted_which=="all" || $voted=="all") {
 		echo(has_voted_for_section());
 	}else{

 		?>

 		<div class="row">
 			<div class="col-lg-12">

 				<div class="row mb-3">
 					<div class="col-xl-4">
 						<section class="card">
 							<header class="card-header">
 								<div class="card-actions">
 									<a href="#" class="card-action card-action-toggle" data-card-toggle></a>

 								</div>

 									<form>

 								<h2 class="card-title">President
 									<li class=" list-unstyled president"> <span class="custom-radio pull-right mt-5">
 										<img src="img/!logged-user.jpg" class="d-none" />
 										<input type="radio" name="selected" value="novote" id="president$idf" class="custom-control-input" checked="checked" />
 										<p class="custom-control-label" for="president$idf" style="cursor: pointer;">No vote</p>
 									</span></li></h2>
 								</header>
 								<div class="card-body">

 										<ul class="list-unstyled search-results-list">


 											<?php 

 											$i = 1;

 											$prez_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='SRC' AND designation='President' AND active='yes'");
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
 														<a href="javascript:void(0);" class="has-thumb" >
 															<div class="result-thumb h4 title text-primary">
 																<?php echo $i ?>
 															</div>
 															<div class="result-thumb">
 																<?php 
 																if ($image=="") {
 																	echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" alt=\"$prez_name\" />";
 																}else{
 																	echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" alt=\"$prez_name\" />";
 																}
 																?>

 															</div>
 															<div class="result-data">
 																<p class="h4 title text-primary"><?php echo $prez_name ?></p>
 															</div>
 															<div class="custom-radio pull-right mt-5">
 																<input type="radio" id="president<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 																<label class="custom-control-label" for="president<?php echo $cand_id ?>"></label>
 															</div>
 														</a>
 													</li>

 													<!-- end of candidates in a while loop for src president -->
 													<?php


 													$i++;

 												}
 											}else{
 												echo no_candidate_found_for_added("Presidency");
 											}

 											?>

 										</ul>

 									
 								</div>
 								</form>

 							</section>
 						</div>


 						<div class="col-xl-4">
 							<section class="card">
 								<header class="card-header">
 									<div class="card-actions">
 										<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 									</div>
 									<form>
 									<h2 class="card-title">Secretary


 										<li class=" list-unstyled secretary"> <span class="custom-radio pull-right mt-5">
 											<img src="img/!logged-user.jpg" class="d-none" />
 											<input type="radio" name="selected" value="novote" id="secretary$idf" class="custom-control-input"  checked="checked"  />
 											<p class="custom-control-label" for="secretary$idf" style="cursor: pointer;">No vote</p>
 										</span></li></h2>
 									</header>
 									<div class="card-body">

 										
 											<ul class="list-unstyled search-results-list">

 												<?php 

 												$i = 1;

 												$sec_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='SRC' AND designation='Secretary' AND active='yes'");
 												if (mysqli_num_rows($sec_query)!==0) {
 													while ($ft_prez = mysqli_fetch_assoc($sec_query)) {
 														$cand_id = $ft_prez["id"];
 														$student_id = $ft_prez["student_id"];
 														$image = $ft_prez["image"];

 														$gen_sec_name = "";
 														$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 														if (mysqli_num_rows($queryInfo)!==0) {

 															$fetch =mysqli_fetch_assoc($queryInfo);
 															$firstname = $fetch["firstname"];
 															$surname = $fetch["surname"];
 															$lastname = $fetch["lastname"];

 															$gen_sec_name = "$firstname $surname $lastname";
 														}else{
 															$gen_sec_name = "";
 														}

 														?>
 														<!-- candidates in a while loop for src secretary -->

 														<li class="secretary">

 															<a href="javascript:void(0);" class="has-thumb" >
 																<div class="result-thumb h4 title text-primary">
 																	<?php echo $i ?>
 																</div>
 																<div class="result-thumb">
 																	<?php 
 																	if ($image=="") {
 																		echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" alt=\"$gen_sec_name\" />";
 																	}else{
 																		echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" alt=\"$gen_sec_name\" />";
 																	}
 																	?>

 																</div>
 																<div class="result-data">
 																	<p class="h4 title text-primary"><?php echo $gen_sec_name ?></p>
 																</div>
 																<div class="custom-radio pull-right mt-5">
 																	<input type="radio" id="secretary<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 																	<label class="custom-control-label" for="secretary<?php echo $cand_id ?>"></label>
 																</div>
 															</a>

 														</li>

 														<!-- end of candidates in a while loop for src secretary -->
 														<?php


 														$i++;

 													}
 												}else{
 													echo no_candidate_found_for_added("Presidency");
 												}

 												?>


 											</ul>

 										

 									</div>
 									</form>
 								</section>
 							</div>




 							<div class="col-xl-4">
 								<section class="card">
 									<header class="card-header">
 										<div class="card-actions">
 											<a href="#" class="card-action card-action-toggle" data-card-toggle></a>
 										</div>
 										<form>
 										<h2 class="card-title">Financial Secretary
 											<li class=" list-unstyled finance"> <span class="custom-radio pull-right mt-5">
 												<img src="img/!logged-user.jpg" class="d-none" />
 												<input type="radio" name="selected" value="novote" id="finance$idf" class="custom-control-input" checked="checked" />
 												<p class="custom-control-label" for="finance$idf" style="cursor: pointer;">No vote</p>
 											</span></li></h2>
 										</header>
 										<div class="card-body">

 											
 												<ul class="list-unstyled search-results-list">								

 													<?php 

 													$i = 1;

 													$finan_query = mysqli_query($conn, "SELECT * FROM candidates WHERE section='SRC' AND designation='Financial Secretary' AND active='yes'");
 													if (mysqli_num_rows($finan_query)!==0) {
 														while ($ft_prez = mysqli_fetch_assoc($finan_query)) {
 															$cand_id = $ft_prez["id"];
 															$student_id = $ft_prez["student_id"];
 															$image = $ft_prez["image"];

 															$finan_sec_name = "";
 															$queryInfo = mysqli_query($conn, "SELECT * FROM students WHERE id='$student_id' AND active='yes'");
 															if (mysqli_num_rows($queryInfo)!==0) {

 																$fetch =mysqli_fetch_assoc($queryInfo);
 																$firstname = $fetch["firstname"];
 																$surname = $fetch["surname"];
 																$lastname = $fetch["lastname"];

 																$finan_sec_name = "$firstname $surname $lastname";
 															}else{
 																$finan_sec_name = "";
 															}

 															?>
 															<!-- candidates in a while loop for financial secretary -->

 															<li class="finance">

 																<a href="javascript:void(0);" class="has-thumb" >
 																	<div class="result-thumb h4 title text-primary">
 																		<?php echo $i ?>
 																	</div>
 																	<div class="result-thumb">
 																		<?php 
 																		if ($image=="") {
 																			echo "<img src=\"img/!logged-user.jpg\" class=\"img-thumbnail rounded-circle\" alt=\"$finan_sec_name\" />";
 																		}else{
 																			echo "<img src=\"$image\" class=\"img-thumbnail rounded-circle\" alt=\"$finan_sec_name\" />";
 																		}
 																		?>

 																	</div>
 																	<div class="result-data">
 																		<p class="h4 title text-primary"><?php echo $finan_sec_name ?></p>
 																	</div>
 																	<div class="custom-radio pull-right mt-5">
 																		<input type="radio" id="fsecretary<?php echo $cand_id ?>" name="selected" value="<?php echo $cand_id ?>" class="custom-control-input">
 																		<label class="custom-control-label" for="fsecretary<?php echo $cand_id ?>"></label>
 																	</div>
 																</a>

 															</li>
 															<!-- end of candidates in a while loop for src finance -->				

 															<?php


 															$i++;

 														}
 													}else{
 														echo no_candidate_found_for_added("Presidency");
 													}

 													?>




 												</ul>

 											

 										</div>
 										</form>
 									</section>
 								</div>

 							</div>	

 						</div>

 						<div class="col-lg-12">
 							<a href="#confirmVote" class="mb-1 mt-1 mr-1 btn btn-primary btn-lg pull-right modal-with-move-anim ws-normal" id="prevAll">Submit Vote</a>
 						</div>
 					</div>
 				</section>
 			</div>


 			<div id="confirmVote" class="zoom-anim-dialog modal-block modal-lg modal-block-info mfp-hide">
 				<section class="card">
 					<header class="card-header">
 						<h2 class="card-title">Confirm SRC Voting</h2>
 					</header>
 					<form method="post" enctype="multipart/form-data">
 						<div class="card-body">
 							<div class="row">
 								<div class="col-lg-4">
 									<div class="content">
 										<ul class="simple-user-list">
 											<li class="presNew">
 												<figure class="image rounded">
 													<img src="" alt="" class="rounded img-fluid presImg" width="50" height="50">
 												</figure>
 												<span class="title text-center presName"></span>
 												<input type="hidden" name="president_id" class="presID" value="novote">
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
 												<input type="hidden" name="secretary_id" class="secID" value="novote">
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
 												<input type="hidden" name="finance_id" class="finID" value="novote">
 												<span class="message truncate text-center">Financial Secretary</span>
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
 				$('.vote').addClass('nav-expanded nav-active');

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

 				$('#prevAll').click(function(){

 					var pTag = $('li.president.active');
 					var president_name = pTag.find('p').text();
 					var president_id = pTag.find('input:radio').val();
 					var president_image = pTag.find('img').attr('src');
src
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

 				});
 			});



 		</script>


 		<?php 

 		if (isset($_POST["conc_vote"])) {
 			$president_id = strip_tags(stripslashes(htmlentities($_POST["president_id"])));
 			$secretary_id = strip_tags(stripslashes(htmlentities($_POST["secretary_id"])));
 			$finance_id = strip_tags(stripslashes(htmlentities($_POST["finance_id"])));

 			if ($president_id=="") {$president_id = "novote"; }
 			if ($secretary_id=="") {$secretary_id = "novote"; }
 			if ($finance_id=="") {$finance_id = "novote"; }


 			$src_prez_gs_fs = "$president_id,$secretary_id,$finance_id";

 			if ($president_id!="" && $secretary_id!="" && $finance_id!="") {
 				$already_voted_for = "";
 				$query_vote = mysqli_query($conn, "SELECT src_prez_gs_fs FROM votes WHERE index_number='$student_index' AND active='yes' LIMIT 1");
 				if (mysqli_num_rows($query_vote)===1) {
 					$already_voted_for = mysqli_fetch_assoc($query_vote) ["src_prez_gs_fs"];
 					mysqli_query($conn,"UPDATE votes SET src_prez_gs_fs='$src_prez_gs_fs' WHERE index_number = '$student_index' AND active='yes'");

 				}else{
 					mysqli_query($conn, "INSERT INTO votes(index_number,src_prez_gs_fs) VALUES('$student_index','$src_prez_gs_fs')");
 				}



 				if ($already_voted_for!="" AND $already_voted_for!==$src_prez_gs_fs) {

 					$exp_old = explode(",", $already_voted_for);
 					$prez_old = current($exp_old);
 					$gs_old = next($exp_old);
 					$fs_old = next($exp_old);

 					$exp_new = explode(",", $src_prez_gs_fs);
 					$prez_new = current($exp_new);
 					$gs_new = next($exp_new);
 					$fs_new = next($exp_new);

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



 							$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='SRC' AND designation='President' AND active='yes' LIMIT 1");
 							if (mysqli_num_rows($query_total_votes)===1) {
 								$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
 								$updated_voter = $total_voters+1;
 								mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='SRC' AND designation='President' AND active='yes'");

 							}else{
 								mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('SRC','President','1')");
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


 							$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='SRC' AND designation='Secretary' AND active='yes' LIMIT 1");
 							if (mysqli_num_rows($query_total_votes)===1) {
 								$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
 								$updated_voter = $total_voters+1;
 								mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='SRC' AND designation='Secretary' AND active='yes'");

 							}else{
 								mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('SRC','Secretary','1')");
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


 							$query_total_votes = mysqli_query($conn, "SELECT * FROM total_voters WHERE section='SRC' AND designation='Financial Secretary' AND active='yes' LIMIT 1");
 							if (mysqli_num_rows($query_total_votes)===1) {
 								$total_voters = mysqli_fetch_assoc($query_total_votes) ["total_votes"];
 								$updated_voter = $total_voters+1;
 								mysqli_query($conn,"UPDATE total_voters SET total_votes='$updated_voter' WHERE section='SRC' AND designation='Financial Secretary' AND active='yes'");

 							}else{
 								mysqli_query($conn, "INSERT INTO total_voters(section,designation,total_votes) VALUES('SRC','Financial Secretary','1')");
 							}
 						}
 					}


 				}

 				$query_vote = mysqli_query($conn, "SELECT has_voted_which FROM accesses WHERE id = '$access_id' AND active='yes' LIMIT 1");
 				$has_voted_which = mysqli_fetch_assoc($query_vote) ["has_voted_which"];
 				if ($has_voted_which=="none") {
 					mysqli_query($conn,"UPDATE accesses SET has_voted_which='src' WHERE id = '$access_id' AND active='yes'");

 				}else{
 					mysqli_query($conn,"UPDATE accesses SET has_voted_which='all',voted='yes' WHERE id = '$access_id' AND active='yes'");

 					?>
 					<script type="text/javascript">
 						alert("You have casted all votes Successfully");
 					</script>
 					<?php

 					logout();
 				}

 				?>
 				<script type="text/javascript">
 					location.replace("vote-department");
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