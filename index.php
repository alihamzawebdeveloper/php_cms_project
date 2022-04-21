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

                 <?php
				 $per_page = 5;
				 if(isset($_GET['page'])){
					 $page = $_GET['page'];
				 }else{
					 $page = "";
				 }
				 if($page == '' || $page == 1 ){
					 $page_1 =0;
				 }else{
					 $page_1 = ($page*$per_page)-$per_page;
				 }
				 $query_for_count = "SELECT * FROM posts";
				 $count_posts = mysqli_query($connection,$query_for_count);
				 $all_posts = mysqli_num_rows($count_posts);
				 $count= ceil($all_posts/$per_page);
				$query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page_1, $per_page";
				$select_all_posts_query = mysqli_query($connection,$query);
				while($all_posts = mysqli_fetch_assoc($select_all_posts_query)){
				$post_id = 	$all_posts['post_id'];
				$post_title = $all_posts['post_title'];
				$post_author = $all_posts['post_author'];
				$post_date = $all_posts['post_date'];
				$post_img = $all_posts['post_img'];
				$post_content = substr($all_posts['post_content'],0,185);
				?>
				

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author?>"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id?>"><img class="img-responsive" src="images/<?php echo $post_img?>" alt=""></a>
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php
				}
				 ?>
                

                <!-- Pager -->
				<ul class="pager">
				<?php
				for($i =1; $i <= $count; $i++){
					if($i == $page){
						echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
					}else
					{echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";}
				}
				?>
				
				</ul>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"?>
<?php include "includes/footer.php"?>