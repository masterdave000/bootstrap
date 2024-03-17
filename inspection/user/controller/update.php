<?php
include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$clean_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$user_id = filter_var($clean_id, FILTER_VALIDATE_INT);

	$clean_inspector_id = filter_var($_POST['inspector_name'], FILTER_SANITIZE_NUMBER_INT);
    $inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
	
	$username = htmlspecialchars($_POST['username']);
	$role = htmlspecialchars(ucwords($_POST['role']));

	$updateuserQuery = "UPDATE users SET
		inspector_id = :clean_inspector_id,
		username = :username,
		role = :role
		WHERE user_id = :user_id
	";

	$updateuserStatement = $pdo->prepare($updateuserQuery);
	$updateuserStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$updateuserStatement->bindParam(':inspector_id', $inspector_id);
	$updateuserStatement->bindParam(':username', $username);
	$updateuserStatement->bindParam(':role', $role);

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