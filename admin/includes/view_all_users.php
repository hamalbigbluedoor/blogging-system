<table class="table table-bordered table-hover">
	<thead>
	  <tr>
	    <th>Id</th>
	    <th>Username</th>
	    <th>Firstname</th>
	    <th>Lastname</th>
	    <th>Email</th>
	    <th>Current Role</th>
	  </tr>
	</thead>
	<tbody>           
		<!-- All users' data is displayed from the database  -->
	<?php read_all_users() ?>
	</tbody>
</table>
            
<?php update_role(); ?>
<?php delete_user(); ?>
