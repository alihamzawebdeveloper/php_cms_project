<?php 
 if(isset($_POST['add_user'])) {
   
            $user_firstname        = $_POST['user_firstname'];
            $user_lastname       = $_POST['user_lastname'];
            $user_role  = $_POST['user_role'];
            $username      = $_POST['username'];
    
            /*$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];*/
    
    
            $user_email         = $_POST['user_email'];
            $user_password      = $_POST['user_password'];
            //$post_date         = date('d-m-y');
       
       // move_uploaded_file($post_image_temp, "../images/$post_image" );
		
		$query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES ('{$username}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', ' ', '{$user_role}')";
        $add_new_user_query = mysqli_query($connection, $query);  
		if($add_new_user_query){
			echo "User Created: ". "<a href='users.php'>Go to Users</a>";
		}
 }
 
 
		?>
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">First Name</label>
          <input type="text" class="form-control" name="user_firstname">
      </div>

         <div class="form-group">
       <label for="category">Last Name</label><br>
       <input type="text" class="form-control" name="user_lastname">
      </div>
      <div class="form-group">
         <label for="title">Role</label>
          <select name="user_role" class="form-control">
		  <option value="Subscriber">Subscriber</option>
		  <option value="Admin">Admin</option>
		  </select>
      </div>
      
   <!-- <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>-->

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="username">
      </div>
      
      <div class="form-group">
         <label for="post_tags">Email</label>
          <input type="text" class="form-control" name="user_email">
      </div>
	  <div class="form-group">
         <label for="post_tags">Password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="add_user" value="Add User">
      </div>


</form>