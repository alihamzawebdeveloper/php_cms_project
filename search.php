<?php include "includes/header.php"?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                 <?php if(isset($_POST['submit'])){
			     $search_for = $_POST['search_for'];
			     $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search_for%'";
				 $search_query = mysqli_query($connection,$query);
				 if(!$search_query){
					 echo "Query Failed";
				 }
				 $rows_count = mysqli_num_rows($search_query);
				 if($rows_count == 0){
					 echo "<h3>No result found</h3>";
				 }else{
				$select_all_posts_query = mysqli_query($connection,$query);
				while($all_posts = mysqli_fetch_assoc($select_all_posts_query)){
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
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
				}
				
                
				 }
				 }
				  ?>
				 
				 
				 
				 
				 
				

                <!-- Pager -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"?>
<?php include "includes/footer.php"?>