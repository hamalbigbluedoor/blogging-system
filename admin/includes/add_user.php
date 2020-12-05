<?php create_user(); ?>

<!-- 
	enctype attribute: 
	- Is used because we have type="file" in the form.
	- Incharge of sending different form data.
-->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="user_firstname">First Name</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="post_status">Last Name</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>

	<select name="user_role" id="">
		<option value="subscriber">Select Options</option>
		<option value="admin">Admin</option>
		<option value="subscriber">Subscriber</option>
	</select>

	<div class="form-group">
		<label for="post_tags">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

	<div class="form-group">
		<label for="post_content">Email</label>
		<input type="email" class="form-control" name="user_email">
	</div>

	<div class="form-group">
		<label for="post_content">Password</label>
		<input type="password" class="form-control" name="user_password">
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_user" value="Add User">
	</div>

</form>
