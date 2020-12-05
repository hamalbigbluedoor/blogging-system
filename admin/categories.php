<?php include "includes/admin_header.php" ?>

<div id="wrapper">

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Welcome to admin
      <small></small>
    </h1>

<div class="col-xs-6"> 

<!-- "Update category" form and query-->

<?php insert_categories(); ?>
<?php
	/** Checks for the 'edit' key in the array 
	*		(in the url link once the edit button is clicked)
	*/ 
	if(isset($_GET['edit'])) {
		$cat_id_string = $_GET['edit'];
	  include "includes/update_categories.php";
	} 
?>

<!-- "Add Category" form -->

<form action="" method="post">
	<div class="form-group">
		<label for="cat_title">Add Category</label>
		<input class="form-control" type="text" name="cat_title">
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="submit" value="Add Category">
	</div>
</form>
</div>

<div class="col-xs-6"> 

<!-- Create Table -->

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Category Title</th>
		</tr>
	</thead>
	<tbody>
		<!-- FIND ALL CATEGORIES QUERY - Displays the Categories titles -->
		<?php find_all_categories(); ?>

		<!-- DELETE QUERY -->
		<?php delete_categories(); ?>
	</tbody>
</table>

</div>

  </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
