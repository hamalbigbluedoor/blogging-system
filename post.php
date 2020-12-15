<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">
<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">

<?php

if (isset($_GET['p_id'])) {
  //  We convert the key so we can check against it
  $get_post_id = $_GET['p_id'];
}
  
// We want the post_id column to equal the p_id we are catching in the URL
$query = "SELECT * FROM posts WHERE post_id = $get_post_id";
$select_all_posts_query = mysqli_query($connection, $query);

// This will pull in dynamic data from the database each time we create a new post
while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
  $post_title = $row['post_title'];
  $post_author = $row['post_author'];
  $post_date = $row['post_date'];
  $post_image = $row['post_image'];
  $post_content = $row['post_content'];
  // We close PHP tag here so we dont need to echo out the whole HTML string
  // The loop is still open 
?>

  <h1 class="page-header">
    Page Heading
    <small>Secondary Text</small>
  </h1>

  <!-- First Blog Post -->
  <h2>
    <a href="#"><?php echo $post_title ?></a>
  </h2>
  <p class="lead">
    by <a href="index.php"><?php echo $post_author ?></a>
  </p>
  <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
  <hr>
  <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
  <hr>
  <p><?php echo $post_content ?></p>

    <hr>
<?php 
} 
?>

</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>

</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php" ?>
