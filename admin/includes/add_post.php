<?php add_post(); ?>

<!-- 
	enctype attribute: 
	- Is used because we have type="file" in the form.
	- Incharge of sending different form data.
-->
<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input type="text" class="form-control" name="post_title">
	</div>

	<div class="form-group">
		<label>Post Category</label>
		<br>
		<!-- A select list to dynamically display all categories in database -->
		<select name="post_category" id="post_category">
			<?php  
				$query = "SELECT * FROM categories";
				$select_categories = mysqli_query($connection, $query);
				confirmQuery($select_categories);

				while($row = mysqli_fetch_assoc($select_categories)) {
					$cat_id = $row['cat_id'];
					$cat_title = $row['cat_title'];
					// the $cat_id is the same as the "post_category_id". The cat_id value is carried by the name="post_category_id option"
					echo "<option value='{$cat_id}'>{$cat_title}</option>";
				}				
		  ?>
		</select>
	</div>

	<div class="form-group">
		<label for="post_author">Post Author</label>
		<input type="text" class="form-control" name="post_author">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status">
	</div>

	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" class="form-control" name="post_image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
	</div>

</form>
