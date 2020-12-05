<?php include "includes/admin_header.php" ?>

<?php read_profile(); ?>

<?php update_profile(); ?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

<div id="page-wrapper">
	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
		  <div class="col-lg-12">
			  <h1 class="page-header">
			    Profile
			    <small><?php echo $_SESSION['username']; ?></small>
			  </h1>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="user_firstname">First Name</label>
						<input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname?>">
					</div>

					<div class="form-group">
						<label for="post_status">Last Name</label>
						<input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname?>">
					</div>

					<select name="user_role" id="">
						<!-- The default user_role will be subscriber if non is selected -->
						<option value="subscriber"><?php echo $user_role ?></option>
					<?php

					if ($user_role == 'admin') {
						echo "<option value='subscriber'>subscriber</option>";
					} else {
						echo "<option value='admin'>admin</option>";
					}

					?>
					</select>

					<div class="form-group">
						<label for="post_tags">Username</label>
						<input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
					</div>

					<div class="form-group">
						<label for="post_content">Email</label>
						<input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
					</div>

					<div class="form-group">
						<label for="post_content">Password</label>
						<input type="password" class="form-control" name="user_password" value="<?php echo $user_password; ?>">
					</div>

					<div class="form-group">
						<input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
					</div>
				</form>
		  </div>
		</div>
	  <!-- /.row -->
	</div>
<!-- /.container-fluid -->
</div>
  <!-- /#page-wrapper -->  
<?php include "includes/admin_footer.php" ?>
