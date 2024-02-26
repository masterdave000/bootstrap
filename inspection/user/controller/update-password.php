<?php
include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'user_id')) {
	$clean_id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$user_id = filter_var($clean_id, FILTER_VALIDATE_INT);

	$currentpassword = htmlspecialchars(md5($_POST['currentpassword']));
	$newpassword = htmlspecialchars(md5($_POST['newpassword']));
	$confirmpassword = htmlspecialchars(md5($_POST['confirmpassword']));

	$userQuery = "SELECT * FROM users WHERE user_id = :user_id AND password = :currentpassword";
	$userStatement = $pdo->prepare($userQuery);
	$userStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$userStatement->bindParam(':currentpassword', $currentpassword);

	if ($userStatement->execute()) {
		$userCount = $userStatement->rowCount();

		if ($userCount === 1) {
			if ($newpassword == $confirmpassword) {

				$updatepasswordQuery = "UPDATE users SET 
					password = :newpassword
					where user_id = :user_id
				";
				$updatepaswwordStatement = $pdo->prepare($updatepasswordQuery);
				$updatepaswwordStatement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
				$updatepaswwordStatement->bindParam(':newpassword', $newpassword);

				if ($updatepaswwordStatement->execute()) {
					$_SESSION['change_pass_success'] = "
						<div class='msgalert alert--success' id='alert'>
							<div class='alert__message'>
								Password Successfully Changed
							</div>
						</div>
					";

					header('location:' . SITEURL . 'inspection/user/');
				} else {
					$_SESSION['change_pass_failed'] = "
						<div class='msgalert alert--danger' id='alert'>
							<div class='alert__message'>	
								Failed To Change Password
							</div>
						</div>
					";

					header('location:' . SITEURL . "inspection/user/change-password.php?user_id=$user_id");
				}
			} else {
				$_SESSION['pass_not_match'] = "
					<div class='msgalert alert--danger' id='alert'>
						<div class='alert__message'>	
							Password Did Not Match, Please Try Again
						</div>
					</div>
				";
				header('location:' . SITEURL . "inspection/user/change-password.php?user_id=$user_id");
			}
		} else {
			$_SESSION['user_not_found'] = "
				<div class='msgalert alert--danger' id='alert'>
					<div class='alert__message'>	
						Invalid Current Password
					</div>
				</div>
			";
			header('location:' . SITEURL . "inspection/user/change-password.php?user_id=$user_id");
		}
	}
}