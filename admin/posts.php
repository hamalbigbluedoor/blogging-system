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
      <small><?php echo $_SESSION['username']; ?></small>
    </h1>

		<?php
		// We set the 'source' key so we can go to a specific page
		if (isset($_GET['source'])) {
			$source = $_GET['source'];
		} else {
			$source = '';
		}

		// Compare the variable to each case
		switch ($source) {
			case 'add_post':
				include "includes/add_post.php";
				break;	
	
			case 'edit_post':
				include "includes/edit_post.php";
				break;	

			default:
				// If we don't find our GET request, display this as default:
				include "includes/view_all_posts.php";
				break;
		}
		?>

  </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/admin_footer.php" ?>
