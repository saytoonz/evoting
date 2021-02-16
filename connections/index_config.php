<?php 
include 'echos/strings.php';
$CCON=mysqli_connect("localhost", "root", "");
if (!$CCON) {
	 die(contact_technicians());
}

if (!mysqli_select_db($CCON,"ev_schools")) {
 	 die(contact_technicians());
}
?>
