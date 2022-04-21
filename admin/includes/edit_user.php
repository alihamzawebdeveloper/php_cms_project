<?php if(isset($_GET['user_id'])){
	$user_id = $_GET['user_id'];
	
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $select_users_by_id = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_users_by_id)) {
        $user_id           = $row['user_id'];
        $username        = $row['username'];
        $user_firstname         = $row['user_firstname'];
        $user_lastname   = $row['user_lastname'];
        $user_email       = $row['user_email'];
		$user_role    = $row['user_role'];
		$user_password      = $row['user_password'];
		
	}
}
if(isset($_POST['update_user'])){
	$user_firstname        = $_POST['user_firstname'];
            $user_lastname       = $_POST['user_lastname'];
            $user_role  = $_POST['user_role'];
            $username      = $_POST['username'];
    
            /*$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];*/
    
    
            $user_email         = $_POST['user_email'];
			$user_password      = $_POST['user_password'];
			$hashed_password =  password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            //$post_date         = date('d-m-y');
       
       // move_uploaded_file($post_image_temp, "../images/$post_image" );
	   $query = "UPDATE users SET username = '{$username}', user_password = '{$hashed_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = $user_id";
	   $update_user = mysqli_query($connection,$query);
	   if($update_user){
		   echo "User Updated";
	   }
}
	?>

<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">First Name</label>
          <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
      </div>

         <div class="form-group">
       <label for="category">Last Name</label><br>
       <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
      </div>
      <div class="form-group">
         <label for="title">Role</label>
          <select name="user_role" class="form-control">
		  <?php
		  if($user_role == 'Subscriber'){
		      echo "<option selected ='true' value='Subscriber'>Subscriber</option>";
		      echo "<option value='Admin'>Admin</option>";
		  }else{
			  echo "<option selected ='true' value='Admin'>Admin</option>";
		      echo "<option value='Subscriber'>Subscriber</option>";
		  }
		  ?>
		  </select>
      </div>
      
   <!-- <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>-->

      <div class="form-group">
         <label for="post_tags">Username</label>
          <input type="text" class="form-control" name="username" value="<?php echo $username;?>">
      </div>
      
      <div class="form-group">
         <label for="post_tags">Email</label>
          <input type="text" class="form-control" name="user_email" value="<?php echo $user_email;?>">
      </div>
	  <div class="form-group">
         <label for="post_tags">Password</label>
          <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>">
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
      </div>


</form>