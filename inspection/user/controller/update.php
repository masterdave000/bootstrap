<?php
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'user_id')) {
	$clean_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$user_id = filter_var($clean_id, FILTER_VALIDATE_INT);

	$fullname = htmlspecialchars(ucwords($_POST['fullname']));
	$username = htmlspecialchars($_POST['username']);

	$updateuserQuery = "UPDATE users SET
		fullname = :fullname,
		username = :username
		WHERE user_id = :user_id
	";

	$updateuserStatement = $pdo->prepare($updateuserQuery);
	$updateuserStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$updateuserStatement->bindParam(':fullname', $fullname);
	$updateuserStatement->bindParam(':username', $username);

	if ($updateuserStatement->execute()) {
		$_SESSION['update'] = "
			<div class='msgalert alert--success' id='alert'>
				<div class='alert__message'>
					User Account Updated Successfully
				</div>
			</div>
		";

		header('location:' . SITEURL . 'inspection/user/');
	} else {
		$_SESSION['update'] = "
			<div class='msgalert alert--danger' id='alert'>
                <div class='alert__message'>	
                    Failed to Update User Account
                </div>
			</div>
		";

		header('location:' . SITEURL . "inspection/user/update-user.php?user_id='$user_id'");
	}
}