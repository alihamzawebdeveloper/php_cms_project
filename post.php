<?php include "includes/header.php"?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                 <?php
				 if(isset($_GET['post_id'])){
				$post_id = $_GET['post_id'];
				$view_count_query = "UPDATE posts SET post_view_count = post_view_count+1 WHERE post_id = $post_id";
				$view_count_add = mysqli_query($connection,$view_count_query);
				$query = "SELECT * FROM posts WHERE post_id = $post_id";
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
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_img?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>

                <hr>
                <?php
				}
				 }else{
					 header("Location: index.php");
				 }
				 
				 ?>
                

                <!-- Pager -->
                
            </div>
			

            <!-- Blog Sidebar Widgets Column -->
            <?php  include "includes/sidebar.php"?>
			
			<!-- Comments Form -->
			<div class="col-md-8">
			<div class="well">
				<?php 
			if(isset($_POST['post_comment'])){
				$comment_post_id = $post_id;
				$comment_author = $_POST['your_name'];
				$comment_email = $_POST['comment_email'];
				$comment_content = $_POST['comment_content'];
				$comment_status = 'approved';
				if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
				$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', '{$comment_status}', now())";
				$insert_comment = mysqli_query($connection,$query);
				if($insert_comment){
					echo "<div class='alert alert-success'>";
                    echo "<strong>Success!</strong> Your comment posted successfully";
                    echo  "</div>";
				}
				$query = "UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = $comment_post_id";
				$comment_count_update = mysqli_query($connection,$query);
			}else{
				echo "<script>alert('No field can be empty');</script>";
			}
			}
			?>
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
					     <div class="form-group">
                         <label for="your_name">Your Name</label>
                         <input type="text" class="form-control" name="your_name">
                          </div>
						   <div class="form-group">
                           <label for="email">Email</label>
                         <input type="email" class="form-control" name="comment_email">
                         </div>
                        <div class="form-group">
						    <label for="your_message">Your Message</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="post_comment">Post Comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
				 <?php 

               
            $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}  AND comment_status = 'approved' ORDER BY comment_id DESC";
            $select_comment_query = mysqli_query($connection, $query);
            if(!$select_comment_query) {

                die('Query Failed' . mysqli_error($connection));
             }
            while ($row = mysqli_fetch_array($select_comment_query)) {
            $comment_date   = $row['comment_date']; 
            $comment_content= $row['comment_content'];
            $comment_author = $row['comment_author'];
                
                ?>
                <div class="media">
                     
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;   ?>
                            <small><?php echo $comment_date;   ?></small>
                        </h4>
                        
                        <?php echo $comment_content;   ?>
 
                    </div>
                </div>
					<?php
					}
					?>
                </div>
                    </div>
                </div>
				</div>
<?php include "includes/footer.php"?>
