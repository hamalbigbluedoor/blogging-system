<?php

/**
*  Edit post
*/

// Checks for the 'p_id' key in the url link of the edit page
if(isset($_GET['p_id'])) {
	$get_post_id = $_GET['p_id'];
}

  // We compare the post_id field to the GET request we get in the url - '$get_post_id'
	$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
	$select_posts_by_id = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
		// One row / One post
		$post_id = $row['post_id'];
		$post_author = $row['post_author'];
		$post_title = $row['post_title'];
		$post_category_id = $row['post_category_id'];
		$post_status = $row['post_status'];
		$post_image = $row['post_image'];
		$post_content = $row['post_content'];
		$post_tags = $row['post_tags'];
		$post_comment_count = $row['post_comment_count'];
		$post_date = $row['post_date'];
	}


/**
*	Update post
*/

// Check for the 'update_post' key from this form's submit button
// Grabs all the fields by the 'name' attributes with the super global $_POST
if(isset($_POST['update_post'])) {
	$post_author = $_POST['post_author'];
	$post_title = $_POST['post_title'];
	$post_category_id = $_POST['post_category_id'];
	$post_status = $_POST['post_status'];
	$post_image = $_FILES['post_image']['name'];
	$post_image_temp = $_FILES['post_image']['tmp_name'];
	$post_content = $_POST['post_content'];
	$post_tags = $_POST['post_tags'];

	move_uploaded_file($post_image_temp, "../images/$post_image");

	if(empty($post_image)) {
		$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
		$select_image = mysqli_query($connection, $query);
		confirmQuery($select_image);

		// Loop through result set from database to get the image
		while ($row = mysqli_fetch_assoc($select_image)) {
			$post_image = $row['post_image'];
		}
	}

	// Set each field to the item in the form (e.g. $post_title)
	$query = "UPDATE posts SET
						post_title = '{$post_title}',
						post_category_id = '{$post_category_id}',
						post_date = now(),
						post_author = '{$post_author}',
						post_status = '{$post_status}',
						post_tags = '{$post_tags}',
						post_content = '{$post_content}',
						post_image = '{$post_image}'
						WHERE post_id = '{$get_post_id}' ";

	$update_post = mysqli_query($connection, $query);
	confirmQuery($update_post);
}

?>


<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="post_title">Post Title</label>
		<input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
	</div>

	<div class="form-group">
		<label>Post Category</label>
		<br>
		<!-- A select list to dynamically display all categories in database -->
		<select name="post_category_id" id="post_category">
		<option value="">Select an option</option>
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
		<input type="text" class="form-control" name="post_author" value="<?php echo $post_author ?>">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status" value="<?php echo $post_status ?>">
	</div>

	<div class="form-group">
		<label>Post Image</label>
		<br>
		<img width="100" src="../images/<?php echo $post_image; ?>" alt="">
		<input type="file" class="form-control" name="post_image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content ?>
		</textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
	</div>

</form>
