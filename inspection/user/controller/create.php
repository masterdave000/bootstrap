<?php

include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'submit')) {
	$fullname = htmlspecialchars(ucwords($_POST["fullname"]));
	$username = htmlspecialchars($_POST["username"]);
	$password1 = htmlspecialchars(md5($_POST["password1"]));
	$password2 = htmlspecialchars(md5($_POST["password2"]));

	if ($password1 == $password2) {

		$insertUserQuery = "INSERT INTO users
			(
				fullname,
				username,
				password
			)
			VALUES
			(
				:fullname,
				:username,
				:password
			)";

		$insertUserStatement = $pdo->prepare($insertUserQuery);
		$insertUserStatement->bindParam(':fullname', $fullname);
		$insertUserStatement->bindParam(':username', $username);
		$insertUserStatement->bindParam(':password', $password1);



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

?>