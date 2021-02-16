 <?php 
 include 'connections/config.php';

 ?> 
 <!DOCTYPE html>
 <html class="fixed">
 <head>


 	<meta charset="UTF-8">

 	<meta name="keywords" content="secured voting, online voting, voting, online, secured" />
 	<meta name="description" content="Advanced and Secured Online Voting Platform">
 	<meta name="author" content="Verbonden Incorporation">


 	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
 	<title>V-Vote System - Login</title>
 	<link rel="shortcut icon" href="img/favicon.png">

 	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">


 	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css" />
 	<link rel="stylesheet" href="vendor/animate/animate.css">

 	<link rel="stylesheet" href="vendor/font-awesome/css/all.min.css" />
 	<link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.css" />


 	<link rel="stylesheet" href="css/v-vote.css" />


 	<link rel="stylesheet" href="css/style.css" />


 	<script src="vendor/modernizr/modernizr.js"></script>

 </head>
 <body>

 	<section class="body-sign">
 		<div class="center-sign">
 			<a href="/" class="logo float-left">
 				<img src="img/logo.png" height="80" alt="V-Vote Electronic System" />
 			</a>

 			<div class="panel card-sign">
 				<div class="card-title-sign mt-3 text-right">
 					<h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
 				</div>
 				<div class="card-body">
 					<form class="check" method="post" enctype="multipart/form-data" >
 						<p>Login As
 							<span class="wort-rotator highlight">
 								<span class="wort-rotator-items">
 									<span>Student</span>
 									<span>Administrator</span>
 									<span>Staff</span>
 								</span>
 							</span>

 						</p>

 						<div class="row">
 							<div class="col-sm-12">
 								<div class="custom-control custom-radio custom-control-inline">
 									<input type="radio" id="power1" name="power" value="student" class="custom-control-input" checked="checked">
 									<label class="custom-control-label" for="power1">Student</label>
 								</div>
 								<div class="custom-control custom-radio custom-control-inline">
 									<input type="radio" id="power2" name="power" value="administrator" class="custom-control-input">
 									<label class="custom-control-label" for="power2">Administrator</label>
 								</div>
 								<div class="custom-control custom-radio custom-control-inline">
 									<input type="radio" id="power3" name="power" value="staff" class="custom-control-input">
 									<label class="custom-control-label" for="power3">EC Staff</label>
 								</div>

 							</div>

 						</div>
 						<div class="form-group mb-3">
 							<label class="opt1"></label>
 							<div class="input-group">
 								<input name="person_id" type="text"   required class="form-control form-control-lg person_id" />
 								<span class="input-group-append">
 									<span class="input-group-text">
 										<i class="fas fa-user"></i>
 									</span>
 								</span>
 							</div>
 						</div>

 						<div class="form-group mb-3">
 							<div class="clearfix">
 								<label class="float-left">Access Code</label>
 								<a href="#accessBox" class="float-right modal-with-move-anim ws-normal">What's Access Code?</a>
 							</div>
 							<div class="input-group">
 								<input name="access_code" type="password" required class="form-control form-control-lg access_code" />
 								<span class="input-group-append">
 									<span class="input-group-text">
 										<i class="fas fa-lock"></i>
 									</span>
 								</span>
 							</div>
 						</div>
 						<!-- Administrator hidden password box -->
 						<div class="form-group mb-3 admin-pass" style="display: none;">
 							<label>Password</label>
 							<div class="input-group">
 								<input name="password" type="password"  class="form-control form-control-lg password" />
 								<span class="input-group-append">
 									<span class="input-group-text">
 										<i class="fas fa-lock "></i>
 									</span>
 								</span>
 							</div>
 						</div>
 						<!-- end of admin password box -->

 						<div class="mt-3 alert alert-danger" style="display: none;">
 							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 							<strong class="errormessage"></strong>
 						</div>
 						<div class="row">
 							<div class="col-sm-12 text-center">
 								<button type="submit" class="btn btn-primary btn-lg container-fluid mt-2 stdn" name="submit" >Login In</button>
 							</div>
 						</div>


 					</form>
 					<!-- Student's further confirmaation input after first stage verification redirects to voting homepage -->
 					<form class="verify" style="display: none;" method="post" enctype="multipart/form-data" >

 						<div class="form-group mb-3">
 							<div class="clearfix">
 								<label class="float-left">Confirmation Code</label>
 								<a href="#confirmBox" class="float-right modal-with-move-anim ws-normal">What's Confirmation Code?</a>
 							</div>
 							<div class="input-group">
 								<input name="confirm_code" type="password" class="form-control form-control-lg"/>
 								<input type="hidden" id="power1" name="power" value="student" class="custom-control-input">
 								<input name="person_id"  type="hidden"  id="person_id"  required class="form-control form-control-lg" />
 								<input name="access_code" type="hidden" id="access_code"  required class="form-control form-control-lg" />
 								<span class="input-group-append">
 									<span class="input-group-text">
 										<i class="fas fa-lock"></i>
 									</span>
 								</span>
 							</div>
 						</div>

 						<div class="row">
 							<div class="col-sm-12 text-center">
 								<button type="submit" class="btn btn-primary btn-lg container-fluid mt-2" name="submit" >Confirm Identity</button>
 							</div>
 						</div>


 					</form>
 					<!-- end of confirmation box -->
 				</div>
 			</div>

 			<p class="text-center text-muted mt-3 mb-3">&copy; Copyright <?=date('Y')?>. All Rights Reserved. V-Vote Team.</p>
 		</div>
 	</section>
 	<!-- what's access code modal -->
 	<div id="accessBox" class="zoom-anim-dialog modal-block modal-block-info mfp-hide">
 		<section class="card">
 			<header class="card-header">
 				<h2 class="card-title">Access Code</h2>
 			</header>
 			<div class="card-body">
 				<div class="modal-wrapper">
 					<div class="modal-icon">
 						<i class="fas fa-info-circle"></i>
 					</div>
 					<div class="modal-text">
 						<h4>Wow!</h4>
 						<p>The fact that you don't what it is, means you are not entitled to use this system. If you think this is a mistake then contact your School's Electoral Commission.</p>
 					</div>
 				</div>
 			</div>
 			<footer class="card-footer">
 				<div class="row">
 					<div class="col-md-12 text-right">
 						<button class="btn btn-info modal-dismiss">Got It!</button>
 					</div>
 				</div>
 			</footer>
 		</section>
 	</div>
 	<!-- end of access code modal -->

 	<!-- beginning of confirmation code modal -->
 	<div id="confirmBox" class="zoom-anim-dialog modal-block modal-block-info mfp-hide">
 		<section class="card">
 			<header class="card-header">
 				<h2 class="card-title">Confirmation Code</h2>
 			</header>
 			<div class="card-body">
 				<div class="modal-wrapper">
 					<div class="modal-icon">
 						<i class="fas fa-info-circle"></i>
 					</div>
 					<div class="modal-text">
 						<h4>Hello Friend!</h4>
 						<p>The confirmation code is an access security key sent to you earlier on to help verify your identity before voting. If you have lost it, you should contact your School's Electoral Commissioner.</p>
 					</div>
 				</div>
 			</div>
 			<footer class="card-footer">
 				<div class="row">
 					<div class="col-md-12 text-right">
 						<button class="btn btn-info modal-dismiss">Got It!</button>
 					</div>
 				</div>
 			</footer>
 		</section>
 	</div>

 	<!-- end of confirmation code modal -->
 	<script src="vendor/jquery/jquery.js"></script>
 	<script src="vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
 	<script src="vendor/popper/umd/popper.min.js"></script>
 	<script src="vendor/bootstrap/js/bootstrap.js"></script>
 	<script src="vendor/nanoscroller/nanoscroller.js"></script>
 	<script src="vendor/magnific-popup/jquery.magnific-popup.js"></script>
 	<script src="vendor/jquery-placeholder/jquery.placeholder.js"></script>
 	<script src="vendor/js/jqueryv-vote.js"></script>
 	<script src="vendor/js/jqueryv-vote.init.js"></script>
 	<script type="text/javascript">

 		(function($) {

 			'use strict';

 			$('.modal-with-move-anim').magnificPopup({
 				type: 'inline',

 				fixedContentPos: false,
 				fixedBgPos: true,

 				overflowY: 'auto',

 				closeBtnInside: true,
 				preloader: false,

 				midClick: true,
 				removalDelay: 300,
 				mainClass: 'my-mfp-slide-bottom',
 				modal: true
 			});

			/*
			Modal Dismiss
			*/
			$(document).on('click', '.modal-dismiss', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
			});


		}).apply(this, [jQuery]);


 		$(document).ready(function() {
 			$('label.opt1').html('Index Number');
 			$('form.check').attr('action','javascript:;');
 			$('.stdn').click(function(){
 				var chk = $('form.check').find('input:radio[id="power1"]');
 				if ($(chk).is(':checked') && $(chk).val() == 'student') {
 					if (($('.access_code').val() && $('.person_id').val()) !="") {
 						var access_code = $('.access_code').val();
 						var person_id = $('.person_id').val();

 						$('#access_code').val(access_code);
 						$('#person_id').val(person_id);
 						$('form.check').hide();
 						$('form.verify').show('fadeIn');
 					}else{
 						alert('Sorry, no fields could be empty');
 					}
 				}


 			});
 			$('input:radio[id="power1"]').change(function(){
 				if ($(this).is(':checked') && $(this).val() == 'student') {
 					$('label.opt1').html('Index Number');
 					$('.admin-pass').hide('fadeInDown');
 					$('.password').removeAttr('required');
 					$('form.check').attr('action','javascript:;');
 				}

 			});

 			$('input:radio[id="power3"]').change(function(){
 				if ($(this).is(':checked') && $(this).val() == 'staff') {
 					$('label.opt1').html('Staff ID');
 					$('.admin-pass').hide('fadeInDown');
 					$('.password').removeAttr('required');
 					$('form.check').attr('action','#');
 				}

 			});
 			$('input:radio[id="power2"]').change(function(){
 				if ($(this).is(':checked') && $(this).val() == 'administrator') {
 					$('label.opt1').html('Admin ID');
 					$('.admin-pass').show('fadeInUp');
 					$('.password').attr('required','required');
 					$('form.check').attr('action','#');
 				}

 			});


 		});
 	</script>
 </body>

 <?php 
 if (isset($_POST['submit'])) {

 	if ((@$_POST['power']=="student")) {
 		$index_numb = strip_tags(htmlentities(stripslashes($_POST['person_id'])));
 		$two_access = strip_tags(htmlentities(stripslashes($_POST['access_code'])));
 		$one_access = strip_tags(htmlentities(stripslashes($_POST['confirm_code'])));

 		$md5_one_access = md5(md5($one_access));


 		if (!empty($index_numb) && !empty($two_access) && !empty($one_access)) {

 			$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='student'  AND can_logine='yes'  AND active='yes' LIMIT 1");
 			if (mysqli_num_rows($query_can_login)===1) {

 				$query_id = mysqli_query($conn, "SELECT id FROM students WHERE index_number='$index_numb' AND active='yes' LIMIT 1");
 				if (mysqli_num_rows($query_id)===1) {

 					$stud_id = mysqli_fetch_assoc($query_id)["id"];

 					$query_access = mysqli_query($conn, "SELECT * FROM accesses WHERE student_id='$stud_id' AND 
 						one_access='$md5_one_access' AND two_access='$two_access' AND active='yes' AND voted='no'");

 					if (mysqli_num_rows($query_access)===1) {

 						$access_id = mysqli_fetch_assoc($query_access)["id"];

 						if (!empty($access_id) && is_numeric($access_id)) {
 							$_SESSION["master_ruler"] = $stud_id;
 							$_SESSION["ruler_strength"] = "sys_0";
 							$_SESSION["access_id"] = $access_id;
 							$_SESSION["who_can_login_now"] = "student";


 							?>
 							<script type="text/javascript">
 								location.replace("home");
 							</script>
 							<?php


 						}else{
 							?>
 							<script type="text/javascript">
 								alert('Unknown Account...!!');
 							</script>
 							<?php
 						}

 					}else{
 						?>
 						<script type="text/javascript">
 							alert('Incorrect credentials...!!');
 						</script>
 						<?php
 					}


 				}else{
 					?>
 					<script type="text/javascript">
 						alert("Unknown Student, please check your index number and try again.");
 					</script>
 					<?php

 				}
 			}else{

 				?>
 				<script type="text/javascript">
 					alert('Access Denied!');
 				</script>
 				<?php
 			}
 		}else{
 			?>
 			<script type="text/javascript">
 				alert('Sorry no field could be empty!');
 			</script>
 			<?php
 		}




 	}elseif ((@$_POST['power']=="administrator")) {

 		$username = strip_tags(htmlentities(stripslashes($_POST["person_id"])));
 		$AccessCode = strip_tags(htmlentities(stripslashes($_POST["access_code"])));
 		$password = strip_tags(htmlentities(stripslashes($_POST["password"])));

 		$md5_pass = md5(md5(md5(md5(md5(md5($password))))));


 		if (!empty($username) && !empty($AccessCode) && !empty($password)) {

 			$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='admin'  AND can_logine='yes' AND active='yes' LIMIT 1");
 			if (mysqli_num_rows($query_can_login)===1) {


 				$query = mysqli_query($conn, "SELECT id FROM system_admin WHERE s_key='$AccessCode' 
 					AND username='$username' AND password='$md5_pass' AND active='yes'");
 				if (mysqli_num_rows($query)===1) {

 					$id = mysqli_fetch_assoc($query)["id"];

 					if (!empty($id) && is_numeric($id)) {
 						$_SESSION["master_ruler"] = $id;
 						$_SESSION["ruler_strength"] = "sys_4";
 						$_SESSION["who_can_login_now"] = "admin";

 						?>
 						<script type="text/javascript">
 							location.replace("admin-cp");
 						</script>
 						<?php
 					}else{
 						?>
 						<script type="text/javascript">
 							alert('Unknown Account...!!');
 						</script>
 						<?php
 					}

 				}else{
 					?>
 					<script type="text/javascript">
 						alert('Incorrect credentials...!!');
 					</script>
 					<?php
 				}
 			}else{

 				?>
 				<script type="text/javascript">
 					alert('Access Denied!');
 				</script>
 				<?php
 			}
 		}else{
 			?>
 			<script type="text/javascript">
 				alert('Sorry no field could be empty!');
 			</script>
 			<?php
 		}




 	}elseif ((@$_POST['power']=="staff")) {
 		$staff_id = strip_tags(htmlentities(stripslashes($_POST["person_id"])));
 		$AccessCode = strip_tags(htmlentities(stripslashes($_POST["access_code"])));

 		$md5_pass = md5(md5(md5(md5(md5(md5($AccessCode))))));



 		if (!empty($staff_id) && !empty($AccessCode)) {

 			$query_can_login = mysqli_query($conn, "SELECT can_logine FROM who_can_login_now WHERE who='staff' AND can_logine='yes' AND active='yes' LIMIT 1");
 			if (mysqli_num_rows($query_can_login)===1) {

 				$query = mysqli_query($conn, "SELECT * FROM staffs WHERE access_code='$md5_pass' AND staff_id='$staff_id'  AND active='yes'");
 				if (mysqli_num_rows($query)===1) {
 					$GRAB = mysqli_fetch_assoc($query);

 					$id = $GRAB["id"];
 					$priority =  $GRAB["priority"];

 					$role="";
 					$loc = "";
 					if ($priority=="role_1") {
 						$role = role_1();
 						$loc = "student-staff";
 					}elseif ($priority=="role_2") {
 						$role = role_2();
 						$loc = "generate-codes";
 					}elseif ($priority=="role_3") {
 						$role = role_3();
 						$loc = "generate-codes";
 					}

 					if (!empty($id) && is_numeric($id)) {
 						$_SESSION["master_ruler"] = $id;
 						$_SESSION["ruler_strength"] = $role;
 						$_SESSION["who_can_login_now"] = "staff";

 						?>
 						<script type="text/javascript">
 							location.replace("<?php echo $loc ?>");
 						</script>
 						<?php
 					}else{
 						?>
 						<script type="text/javascript">
 							alert('Unknown Account...!!');
 						</script>
 						<?php
 					}

 				}else{
 					?>
 					<script type="text/javascript">
 						alert('Incorrect credentials...!!');
 					</script>
 					<?php
 				}
 			}else{

 				?>
 				<script type="text/javascript">
 					alert('Access Denied!');
 				</script>
 				<?php
 			}
 		}else{
 			?>
 			<script type="text/javascript">
 				alert('Sorry no field could be empty!');
 			</script>
 			<?php
 		}


 	}else{
 		echo "<script> alert('You are logging in as an Imposter. Get out my friend') </script>";
 	}

 }









 include 'connections/close_config.php';
 ?>
 </html>