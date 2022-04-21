<?php include "includes/header.php"?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                 <?php
				$author = $_GET['author'];
				$query = "SELECT * FROM posts WHERE post_author = '{$author}'";
				$select_all_posts_query = mysqli_query($connection,$query);
				while($all_posts = mysqli_fetch_assoc($select_all_posts_query)){
				$post_id	= $all_posts['post_id'];
				$post_title = $all_posts['post_title'];
				$post_author = $all_posts['post_author'];
				$post_date = $all_posts['post_date'];
				$post_img = $all_posts['post_img'];
				$post_content = $all_posts['post_content'];
				?>
				

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <?php echo $post_author?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>
                <?php
				}
				 ?>
                

                <!-- Pager -->
                
            </div>
			

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"?>
                    </div>
                </div>
				</div>
<?php include "includes/footer.php"?>
