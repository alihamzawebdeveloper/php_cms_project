<?php
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
}

?>

<div class="col-md-4">
               
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
					<form action="search.php" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search_for">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
					</form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                               
                  
        <?php 
        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($connection,$query);         
        ?>
                 <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                              
                              <?php 

        while($row = mysqli_fetch_assoc($select_categories_sidebar )) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";


        }
   
                            ?>
                              
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>
				<div class="well">
				<?php
				if(!isset($_SESSION['username'])){?>
                <h4>Login</h4>
                <form method="post" action="includes/login.php">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>

                  <div class="input-group">
                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                    <span class="input-group-btn">
                       <button class="btn btn-primary" name="login" type="submit">Submit
                       </button>
                    </span>
                   </div>
				   </form>
				<?php }else{
					echo "<h4>Loggedin in as {$_SESSION['username']}</h4>";
					echo "<a class='btn btn-primary' href='includes/logout.php'>Logout
                       </a>";
				}
					?>
				
                </div>
                <!-- Side Widget Well -->
            <?php include "widget.php";?>

            </div>

        </div>
        <!-- /.row -->

        <hr>