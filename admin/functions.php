<?php  

/**
*  Checks if query is working
*/
function confirmQuery($result) {
	global $connection;

	if(!$result) {
		die("QUERY failed <br>" . mysqli_error($connection));
	}
}

/*************** Categories section ***************/

/**
*  CREATES Categories into the table
*/

function insert_categories() {
	global $connection;

  if(isset($_POST['submit'])) {
		$cat_title = $_POST['cat_title'];
		// If field is empty 
	
		if($cat_title == "" || empty($cat_title)) {
			echo "This field should not be empty";
		} else {
			/* Inserts into cat_title column of the categories table 
			   by getting the string value entered into the form */

			$query = "INSERT INTO categories(cat_title) VALUE('$cat_title')";
			$create_category_query = mysqli_query($connection, $query);

			if(!$create_category_query) {
				die('QUERY FAILED' . mysqli_error($connection, $query));
			}
		}
	}
}

/**
*	 READ CATEGORIES - displays them into the table
*/ 

function find_all_categories() {
	global $connection;
	$query = "SELECT * FROM categories";
  $select_categories = mysqli_query($connection, $query);

	// Dynamically display the category id and titles as table data
  while($row = mysqli_fetch_assoc($select_categories)) {
  	$cat_title = $row['cat_title'];
  	$cat_id = $row['cat_id'];

		echo "<tr>";
  	echo "<td>$cat_id</td>";
  	echo "<td>$cat_title</td>";
  	echo "<td><a href='categories.php?delete=$cat_id'>Delete</a></td>";
		// ?edit= makes a key in the array $_GET & $cat_id is the value
  	echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
		echo "</tr>";
  }
}

/**
*  DELETES categories from table
*/

function delete_categories() {
	global $connection;

	if(isset($_GET['delete'])) {
		$cat_id_string = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = $cat_id_string ";
		$delete_query = mysqli_query($connection, $query);
		// This refresh's the page - another request for the page
		header("Location: categories.php");
	}
}

/*************** Posts section ***************/

/**
*	 Read all posts
*/

function read_all_posts() {
	global $connection;
	$query = "SELECT * FROM posts";
	$select_posts = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_posts)) {
		// One row / One post
		$post_id = $row['post_id'];
		$post_author = $row['post_author'];
		$post_title = $row['post_title'];
		$post_category_id = $row['post_category_id'];
		$post_status = $row['post_status'];
		$post_image = $row['post_image'];
		$post_tags = $row['post_tags'];
		$post_comment_count = $row['post_comment_count'];
		$post_date = $row['post_date'];

		echo "<tr>";
			echo "<td>{$post_id}</td>";
			echo "<td>{$post_author}</td>";
			echo "<td>{$post_title}</td>";

			$query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}' ";
			$select_categories_id = mysqli_query($connection, $query);
			
			while ($row = mysqli_fetch_assoc($select_categories_id)) {
				$cat_id = $row['cat_id'];
				$cat_title = $row['cat_title'];
				
				echo "<td>{$cat_title}</td>";	
			}
			echo "<td>{$post_status}</td>";
			echo "<td><img width='100' src='../images/{$post_image}' alt='image'></td>";
			echo "<td>{$post_tags}</td>";
			echo "<td>{$post_date}</td>";
			// We pass two parameters with the '&' - 'edit_post' page and the specific posts id 'p_id'
			echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
			// The 'delete' is the key we use in the $_GET
			echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
		echo "</tr>";
	}
}

/**
*  CREATE a post
*/

function add_post() {
	global $connection;
	
	if (isset($_POST['create_post'])) {
		$post_title = $_POST['post_title'];
	  $post_category_id = $_POST['post_category'];
		$post_author = $_POST['post_author'];
		$post_status = $_POST['post_status'];
		// superglobal file is used for type="file"
		$post_image = $_FILES['post_image']['name'];
		// File is saved temporarily when we click on 'choose file'
		$post_image_temp = $_FILES['post_image']['tmp_name'];
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		$post_date = date('d-m-y');
		$post_comment_count = 4;
		// Moves file from temp location to our folder
		move_uploaded_file($post_image_temp, "../images/$post_image");

		// Inserts into referenced column in posts table
		$query = "INSERT INTO posts (
								 post_category_id,
								 post_title,
								 post_author,
								 post_date,
								 post_image,
								 post_content,
								 post_tags,
								 post_comment_count,
								 post_status
							)"; 
		// These values are coming in from the form
		// Use single quotes for strings, use now() to format the $post_date
		$query .= "VALUES (
									{$post_category_id},
								 '{$post_title}',
								 '{$post_author}',
								 	now(),
								 '{$post_image}',
								 '{$post_content}',
								 '{$post_tags}',
								 '{$post_comment_count}',
								 '{$post_status}'
							)";

		$create_post_query = mysqli_query($connection, $query);
		confirmQuery($create_post_query);
	}
}

/*************** Users section ***************/

/**
*	 CREATES a user
*/
function create_user() {
	global $connection;

	if (isset($_POST['create_user'])) {
	  $user_firstname = ($_POST['user_firstname']);
	  $user_lastname  = ($_POST['user_lastname']);
	  $user_role = ($_POST['user_role']);
	  $username = ($_POST['username']);
	  $user_email = ($_POST['user_email']);
		$user_password = ($_POST['user_password']);

	  $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";
	  $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') "; 
	  $create_user_query = mysqli_query($connection, $query);  
	  confirmQuery($create_user_query);
	}
}

/**
*	 READS all users data
*/
function read_all_users() {
	global $connection;
	$query = "SELECT * FROM users";
	$select_users = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc($select_users)) {
	  $user_id = $row['user_id'];
	  $username = $row['username'];
	  $user_password = $row['user_password'];
	  $user_firstname = $row['user_firstname'];
	  $user_lastname = $row['user_lastname'];
	  $user_email = $row['user_email'];
	  $user_role = $row['user_role'];
	    
	  echo "<tr>";      
	  echo "<td>$user_id </td>";
	  echo "<td>$username</td>";
	  echo "<td>$user_firstname</td>";
	  echo "<td>$user_lastname</td>";
	  echo "<td>$user_email</td>";
	  echo "<td>$user_role</td>";
	  echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
	  echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
		/**
		* The first parameter source=edit_user is from switch statement in users.php,
		* the second parameter we equal the edit_user key to our dynamic $user_id.
		* We recieve the parameter from the get request via the url
		*/
	  echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
	  echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
	  echo "</tr>";
	}
}

/**
*  Update a User 
*/
function update_user() {
	global $connection;
	global $username;
  global $user_password;
  global $user_firstname;
  global $user_lastname;
  global $user_email; 
  global $user_role; 
	// Get request user id and database data extraction
	if (isset($_GET['edit_user'])) {
  	$get_user_id = $_GET['edit_user'];
		$query = "SELECT * FROM users WHERE user_id = $get_user_id ";
		$select_users_query = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_assoc($select_users_query)) {
		  $user_id = $row['user_id'];
		  $username = $row['username'];
		  $user_password = $row['user_password'];
		  $user_firstname = $row['user_firstname'];
		  $user_lastname = $row['user_lastname'];
		  $user_email = $row['user_email'];
		  $user_role = $row['user_role'];
		}
	}
	// Post request to update user
	if (isset($_POST['edit_user'])) {
	  $username = $_POST['username'];
	  $user_password = $_POST['user_password'];
	  $user_firstname = $_POST['user_firstname'];
	  $user_lastname = $_POST['user_lastname'];
	  $user_email = $_POST['user_email'];
	  $user_role = $_POST['user_role'];
		// Set each field to the item in the form (e.g. $post_title)
		$query = "UPDATE users SET
							username = '{$username}',
							user_password = '{$user_password}',
							user_firstname = '{$user_firstname}',
							user_lastname = '{$user_lastname}',
							user_email = '{$user_email}',
							user_role = '{$user_role}'
							WHERE user_id = {$get_user_id} ";

		$update_user_query = mysqli_query($connection, $query);
		confirmQuery($update_user_query);
	}
}

/**
*  UPDATE a user's role
*/
function update_role() {
	global $connection;
	// Change to Admin
	if (isset($_GET['change_to_admin'])) { 
	  $the_user_id = ($_GET['change_to_admin']);

	  $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
	  $change_to_admin_query = mysqli_query($connection, $query);
	  header("Location: users.php");
	}

	// Change to subscriber
	if (isset($_GET['change_to_sub'])) { 
	  $the_user_id = ($_GET['change_to_sub']);

	  $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
	  $change_to_sub_query = mysqli_query($connection, $query);
	  header("Location: users.php");
	}
}

/**
*  DELETE a user
*/
function delete_user() {
	global $connection;
	// Delete a User
	if (isset($_GET['delete'])) {
	  $the_user_id = ($_GET['delete']);

	  $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
	  $delete_user_query = mysqli_query($connection, $query);
	}
}

/*************** PROFILE section ***************/

function read_profile() {
	global $connection;
	global $username;
  global $user_password;
  global $user_firstname;
  global $user_lastname;
  global $user_email; 
  global $user_role; 

	if (isset($_SESSION['username'])) {
		$username = $_SESSION['username'];
		$query = "SELECT * FROM users WHERE username = '{$username}' ";
		$select_user_profile_query = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_array($select_user_profile_query)) {
		  $user_id = $row['user_id'];
		  $username = $row['username'];
		  $user_password = $row['user_password'];
		  $user_firstname = $row['user_firstname'];
		  $user_lastname = $row['user_lastname'];
		  $user_email = $row['user_email'];
		  $user_role = $row['user_role'];
		}
	}
}

function update_profile() {
	global $connection;

	if (isset($_POST['edit_user'])) {
	  $username = $_POST['username'];
	  $user_password = $_POST['user_password'];
	  $user_firstname = $_POST['user_firstname'];
	  $user_lastname = $_POST['user_lastname'];
	  $user_email = $_POST['user_email'];
	  $user_role = $_POST['user_role'];
		// Set each field to the item in the form (e.g. $post_title)
		$query = "UPDATE users SET
							username = '{$username}',
							user_password = '{$user_password}',
							user_firstname = '{$user_firstname}',
							user_lastname = '{$user_lastname}',
							user_email = '{$user_email}',
							user_role = '{$user_role}'
							WHERE username = '{$username}' ";

		$update_user_query = mysqli_query($connection, $query);
		confirmQuery($update_user_query);
	  header("Location: profile.php");
	}
}
?>