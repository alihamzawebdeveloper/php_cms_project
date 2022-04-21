<?php 
include "db.php";
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				<?php 
				$query = "SELECT * FROM categories";
				$select_all_categories_query = mysqli_query($connection,$query);
				
				while($all_categories = mysqli_fetch_assoc($select_all_categories_query)){
				$category_id = $all_categories['cat_id'];	
				$category_title = $all_categories['cat_title'];
				$category_class = '';
				$registratin_class = '';
				$pagename = basename($_SERVER['PHP_SELF']);
				$registration = 'registration.php';
				if(isset($_GET['cat_id']) && $_GET['cat_id'] == $category_id){
					$category_class = 'active';
				} else if($pagename == $registration ) {
					$registratin_class = 'active';
				}
				echo "<li class='$category_class'><a href='category.php?cat_id=$category_id'>{$category_title}</a></li>";
				}
				?>
				<li><a href='admin'>Admin</a></li>
				<li class="<?php echo $registratin_class?>"><a href='registration.php'>Register</a></li>
				<?php 
				if((isset($_SESSION['user_role'])) && (isset($_GET['post_id']))){
					$post_id = $_GET['post_id'];
					echo "<li><a href='admin/posts.php?source=edit_post&post_id=$post_id'>Edit Post</a></li>";
				}
				?>
                </ul>
				?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
