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

// If submit button in the form is set, then echo something 
if(isset($_POST['submit'])) {
  $search = $_POST['search'];  

  // Goes to the post table where post_tags are compared to the string that is typed into the input field by the user.
  $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
  // Send it to the DB
  $search_query = mysqli_query($connection, $query);  

  if (!$search_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
  
  //  Checks if there are any results coming in from the DB
  $count = mysqli_num_rows($search_query); 

  if($count == 0) {
    echo "NO RESULT";
  } else {
    // This will pull in dynamic data from the database each time we create a new post
    while($row = mysqli_fetch_assoc($search_query)){
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
    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>
<?php 
    } 
  }
}
?>

</div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php" ?>

</div>
<!-- /.row -->

<hr>

<?php include "includes/footer.php" ?>
