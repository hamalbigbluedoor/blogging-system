<!-- Starts the session, tells our service to prepare the session -->
<?php session_start(); ?>

<?php

// Cancel the current user's session
$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");

?>

