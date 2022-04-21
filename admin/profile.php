<?php include "includes/header.php";?>
    <div id="wrapper">

<?php include "includes/navigation.php";?>
		
        <?php 
		if(isset($_SESSION['username'])){
			$username = $_SESSION['username'];
			$query = "SELECT * FROM users WHERE username = '{$username}'";
			$select_user = mysqli_query($connection, $query);
			while($row = mysqli_fetch_assoc($select_user)){
				$user_id           = $row['user_id'];
                $username        = $row['username'];
                $user_firstname         = $row['user_firstname'];
                $user_lastname   = $row['user_lastname'];
                $user_email       = $row['user_email'];
		        $user_role    = $row['user_role'];
			}
		}
		?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Area
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
						<form action="" method="post" enctype="multipart/form-data">    
     <?php if(isset($_POST['update_profile'])){
	        $user_firstname        = $_POST['user_firstname'];
            $user_lastname       = $_POST['user_lastname'];
            $user_role  = $_POST['user_role'];
            $username      = $_POST['username'];
    
            /*$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];*/
    
    
            $user_email         = $_POST['user_email'];
            //$post_date         = date('d-m-y');
       
       // move_uploaded_file($post_image_temp, "../images/$post_image" );
	   $query = "UPDATE users SET username = '{$username}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = $user_id";
	   $update_user = mysqli_query($connection,$query);
	   if($update_user){
		   echo "User Profile Updated";
	   }
	 }?>
     
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
	  <!--<div class="form-group">
         <label for="post_tags">Password</label>
          <input type="text" class="form-control" name="user_password">
      </div>-->
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
      </div>


</form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>