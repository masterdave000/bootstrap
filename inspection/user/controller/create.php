<?php

include './../../../config/constants.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$clean_inspector_id = filter_var($_POST['inspector_name'], FILTER_SANITIZE_NUMBER_INT);
	$inspector_id = filter_var($clean_inspector_id, FILTER_VALIDATE_INT);
	$username = htmlspecialchars($_POST["username"]);
	$password1 = htmlspecialchars(md5($_POST["password1"]));
	$password2 = htmlspecialchars(md5($_POST["password2"]));
	$role = htmlspecialchars(ucwords($_POST['role']));

	if ($password1 == $password2) {

		$userDuplicate = "SELECT user_id FROM user_view WHERE username = :username";
		$userStatement = $pdo->prepare($userDuplicate);
		$userStatement->bindParam(':username', $username);
		$userStatement->execute();

		$userCount = $userStatement->rowCount();

		if ($userCount > 0) {
			$_SESSION['duplicate'] = "
			<div class='msgalert alert--danger' id='alert'>
				<div class='alert__message'>	
					$username Already Exist
				</div>
			</div>
			
			";

			header('location:' . SITEURL . 'inspection/user/add-user.php');
			exit;
		}

		$insertUserQuery = "INSERT INTO users
			(
				inspector_id,
				username,
				password,
				role
			)
			VALUES
			(
				:inspector_id,
				:username,
				:password,
				:role
			)";

		$insertUserStatement = $pdo->prepare($insertUserQuery);
		$insertUserStatement->bindParam(':inspector_id', $inspector_id);
		$insertUserStatement->bindParam(':username', $username);
		$insertUserStatement->bindParam(':password', $password1);
		$insertUserStatement->bindParam(':role', $role);



		if ($insertUserStatement->execute()) {
			//To show display messege once data has been inserted
			$_SESSION['add'] = "
				<div class='msgalert alert--success' id='alert'>
                    <div class='alert__message'>
                        User Profile Created Successfully
                    </div>
                </div>
			";

			//Redirecting page to manage user
			header("location:" . SITEURL .	'inspection/user/');
		} else {
			//To show display messege once data has been inserted
			$_SESSION['add'] = "
				<div class='msgalert alert--danger' id='alert'>
					<div class='alert__message'>	
						Failed to Create User Profile
					</div>
				</div>
			";

			//Redirecting page to add user
			header("location:" . SITEURL .	'inspection/user/add-user.php');
		}
	} else {
		$_SESSION['pass_not_match'] = "
			<div class='msgalert alert--danger' id='alert'>
				<div class='alert__message'>	
					Password Did Not Match
				</div>
			</div>
		";

		//Redirecting page to add user
		header("location:" . SITEURL . 'inspection/user/add-user.php');
	}
}
