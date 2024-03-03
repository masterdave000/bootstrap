<?php
if (!isset($_SESSION['user_id'])) {
	$_SESSION['error_login'] = "
	<div class='msgalert alert--danger' id='alert'>
		<div class='alert__message'>
			Sign in Failed
		</div>
	</div>";

	header('location:' . SITEURL);
	exit();
}