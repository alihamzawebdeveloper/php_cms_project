<?php
if(isset($_GET['user_id'])){
	$user_id = $_GET['user_id'];
	$query = "DELETE FROM users WHERE user_id =$user_id";
	$delete_user = mysqli_query($connection,$query);
	if($delete_user){
		echo "User deleted successfully";
	}
}
?>
<table class="table table-bordered table-hover">
	  <thead>
                   <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
						<th>Edit</th>
						<th>Delete</th>
                    </tr>
                </thead>
				<tbody>
<?php

            $query = "SELECT * FROM users";
            $select_users_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_users_query)) {
            $user_id             = $row['user_id'];
            $username            = $row['username'];
			
            $user_password       = $row['user_password']; 
            $user_firstname      = $row['user_firstname'];
            $user_lastname       = $row['user_lastname'];
            $user_email          = $row['user_email'] ; 
            $user_image          = $row['user_image']; 
			$user_role           = $row['user_role']; 
			echo "<tr>";
			echo "<td>{$user_id}</td>";
			echo "<td>{$username}</td>";
			echo "<td>{$user_firstname}</td>";
			echo "<td>{$user_lastname}</td>";
			echo "<td>{$user_email}</td>";
			echo "<td>{$user_role}</td>";
			echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>Edit</a></td>";
			echo "<td><a href='users.php?user_id=$user_id'>Delete</a></td>";
			echo "</tr>";
          }
		  ?>
		  </tbody>
	  </table>

        </div>
		</div>
		</div>
		
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>
		  