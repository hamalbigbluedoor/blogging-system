<?php update_user(); ?>

<!-- 
	enctype attribute: 
	- Is used because we have type="file" in the form.
	- Incharge of sending different form data.
-->
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
		<input type="submit" class="btn btn-primary" name="edit_user" value="Update">
	</div>

</form>
