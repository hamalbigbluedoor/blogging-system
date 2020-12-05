<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Title</th>
			<th>Category</th>
			<th>Status</th>
			<th>Image</th>
			<th>Tags</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
	<!-- All posts' data is displayed from the database  -->
	<?php read_all_posts(); ?>
	</tbody>
</table>

<?php

if(isset($_GET['delete'])) {
	$the_post_id = $_GET['delete'];

	$query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
	$delete_query = mysqli_query($connection, $query);
	confirmQuery($delete_query);
}

?>
