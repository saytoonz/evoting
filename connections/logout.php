<?php

include "config.php" ;


if (session_destroy()) {
	?>
	<script type="text/javascript">
			location.replace("login");
	</script>
	<?php
}else{

	session_write_close();
	?>
	<script type="text/javascript">
		location.replace("login");
	</script>
	<?php
}

?>


