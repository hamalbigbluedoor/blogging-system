<?php include "db.php"; ?>
<!-- Starts the session, tells our service to prepare the session -->
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
	// Store details from the form via the 'name' attr keywords
	$username = $_POST['username'];
	$password = $_POST['password'];
	// Re-assign variables - Ensure info from users doesn't have sql injection in it
	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT * FROM users WHERE username = '{$username}' ";
	// Results of data entered are stored in this variable
	$select_user_query = mysqli_query($connection, $query);

	if (!$select_user_query) {
		die("QUERY FAILED" . mysqli_error($connection));
	}

	// Loop through all values in array and assign indexes to variables
	while($row = mysqli_fetch_array($select_user_query)) {
		 $db_user_id = $row['user_id'];
		 $db_username = $row['username'];
		 $db_user_password = $row['user_password'];
		 $db_user_firstname = $row['user_firstname'];
		 $db_user_lastname = $row['user_lastname'];
		 $db_user_role = $row['user_role'];
	}

	/**
 	*	 Login verification
  */

	// If data entered by user matches the database then redirect them to admin
	if ($username === $db_username && $password === $db_user_password) {
		// Assion database data to sessions (custom keys are created e.g. firstname)
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;

		header("Location: ../admin");
	} else {
	  // If data entered doesn't match the database
		header("Location: ../index.php");
	}
}

?>

