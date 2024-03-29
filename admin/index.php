<?php include "includes/header.php";?>
    <div id="wrapper">

<?php include "includes/navigation.php";?>
		
<?php
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$timeout = $time - $time_out_in_seconds;
$query = "SELECT * FROM users_online WHERE session = '$session'";
$send_query = mysqli_query($connection,$query);
$count = mysqli_num_rows($send_query);
if($count == NULL){
	mysqli_query($connection,"INSERT INTO users_online(session,time)VALUES('$session','$time')");
}else{
	mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
}
   $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeout'");
   $count_user = mysqli_num_rows($users_online);
   
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
                    </div>
                </div>
				<h3><?php echo $count_user;?></h3>
                <!-- /.row -->
				               <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
					<?php
					$query = "SELECT * FROM posts";
					$select_post = mysqli_query($connection,$query);
					$post_count = mysqli_num_rows($select_post);
					?>
                  <div class='huge'><?php echo $post_count;?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
					<?php
					$query = "SELECT * FROM comments";
					$select_comment = mysqli_query($connection,$query);
					$comment_count = mysqli_num_rows($select_comment);
					?>
                     <div class='huge'><?php echo $comment_count;?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
					<?php
					$query = "SELECT * FROM users";
					$select_users = mysqli_query($connection,$query);
					$users_count = mysqli_num_rows($select_users);
					?>
                    <div class='huge'><?php echo $users_count;?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
					<?php
					$query = "SELECT * FROM categories";
					$select_categories = mysqli_query($connection,$query);
					$categories_count = mysqli_num_rows($select_categories);
					?>
                        <div class='huge'><?php echo $categories_count;?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php
$query = "SELECT * FROM posts WHERE post_status = 'Published' ";
$select_all_published_posts = mysqli_query($connection,$query);
$post_published_count = mysqli_num_rows($select_all_published_posts);
                                     

                                      
$query = "SELECT * FROM posts WHERE post_status = 'Draft' ";
$select_all_draft_posts = mysqli_query($connection,$query);
$post_draft_count = mysqli_num_rows($select_all_draft_posts);


$query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
$unapproved_comments_query = mysqli_query($connection,$query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);


$query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
$select_all_subscribers = mysqli_query($connection,$query);
$subscriber_count = mysqli_num_rows($select_all_subscribers);

?>
                <!-- /.row -->
            <div class="row">
			<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
		  <?php
		  $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
		  $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comment_count, $users_count, $subscriber_count, $categories_count];
		  for($i=0; $i<8; $i++){
          echo "['{$element_text[$i]}'". ", ". "{$element_count[$i]}],";
		  }
		  
?>
         // ['Post', 1000],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
			
			<div id="columnchart_material" style=" width: auto; margin-top:40px; height: 500px;"></div>
			</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>