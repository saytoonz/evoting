

<?php 

include 'session.php';
include 'strings.php';
include 'enums.php';

$conn=mysqli_connect("localhost", "root", "");
if (!$conn) {
	?>
	<script type="text/javascript"> alert('Sorry there was an error, contact the technicians for fixing.');</script>
	<?php
	logout();
}

if (!mysqli_select_db($conn, "ev_ue_nr__db")) 
{
	?>
	<script type="text/javascript">
		alert('Sorry there was an error, contact the technicians for fixing.');
	</script>
	<?php
	logout(); 
}


?>
