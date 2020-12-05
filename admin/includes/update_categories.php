<div class="col-xs-6"> 
<form action="" method="post">
	<div class="form-group">
		<label for="cat_title">Edit Category</label>

		<?php 
		// UPDATE Category Query - Allows us to display the edit button for the cat_title in the inpiut field

		if(isset($_GET['edit'])) {
			// Get request variable
			$cat_id_string = $_GET['edit'];
			$query = "SELECT * FROM categories WHERE cat_id = '{$cat_id_string}' ";
			$select_categories_id = mysqli_query($connection, $query);
			
			while($row = mysqli_fetch_assoc($select_categories_id)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
		?>
				<input value="<?php if(isset($cat_title)){ echo $cat_title; } ?>" class="form-control" type="text" name="cat_title">
		<?php
			}
		}		
		?>
		<?php 
			// UPDATE Category Query - We can change the value of the title by clicking on the 'Update Category' button

			if(isset($_POST['update_category'])) {
				$cat_title_string = $_POST['cat_title'];
				$query = "UPDATE categories SET cat_title = '{$cat_title_string}' WHERE cat_id = '{$cat_id_string}' ";
				$update_query = mysqli_query($connection, $query);

				if(!$update_query) {
					die("QUERY failed!" . mysqli_error($connection));
				}
			}
		?>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
	</div>
</form>
</div>
