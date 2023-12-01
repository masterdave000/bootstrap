<?php

include './../../../config/constants.php';

if (filter_has_var(INPUT_POST, 'submit')) {
	$fullname = htmlspecialchars(ucwords($_POST["fullname"]));
	$username = htmlspecialchars($_POST["username"]);
	$password1 = htmlspecialchars(md5($_POST["password1"]));
	$password2 = htmlspecialchars(md5($_POST["password2"]));

	if ($password1 == $password2) {

		$insertadminQuery = "INSERT INTO users
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

		$insertadminStatement = $pdo->prepare($insertadminQuery);
		$insertadminStatement->bindParam(':fullname', $fullname);
		$insertadminStatement->bindParam(':username', $username);
		$insertadminStatement->bindParam(':password', $password1);



		if ($insertadminStatement->execute()) {
			//To show display messege once data has been inserted
			$_SESSION['add'] = "
				<div class='msgalert alert--success' id='alert'>
                    <div class='alert__message'>
                        Admin Profile Created Successfully
                    </div>
                </div>
			";

			//Redirecting page to manage admin
			header("location:" . SITEURL .	'inspection/admin/');
		} else {
			//To show display messege once data has been inserted
			$_SESSION['add'] = "
				<div class='msgalert alert--danger' id='alert'>
					<div class='alert__message'>	
						Failed to Create Admin Profile
					</div>
				</div>
			";

			//Redirecting page to add admin
			header("location:" . SITEURL .	'inspection/admin/add-admin.php');
		}
	} else {
		$_SESSION['pass_not_match'] = "
			<div class='msgalert alert--danger' id='alert'>
				<div class='alert__message'>	
					Password Did Not Match
				</div>
			</div>
		";

		//Redirecting page to add admin
		header("location:" . SITEURL . 'inspection/admin/add-admin.php');
	}
}

?>