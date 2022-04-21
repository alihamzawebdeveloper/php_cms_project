<?php if(isset($_GET['comment_id']) && !isset($_GET['comment']))
      {
		  $delete_comment_id = $_GET['comment_id'];
		  $query = "DELETE FROM comments WHERE comment_id = $delete_comment_id";
		  $delete_comment = mysqli_query($connection, $query);
		  if($delete_comment){
			  echo "Comment deleted";
		  }
		  $comment_post_id = $_GET['post_id'];
		  $query = "UPDATE posts SET post_comment_count = post_comment_count-1 WHERE post_id = $comment_post_id";
		  $comment_count_update = mysqli_query($connection,$query);
	  }
	  if(isset($_GET['comment_id']) && isset($_GET['comment'])){
		  if($_GET['comment'] == 'unapprove'){
		  $comment_to_unapprove = $_GET['comment_id'];
		  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_to_unapprove";
		  $unapprove_comment = mysqli_query($connection,$query);
		  if($unapprove_comment){
			  echo "comment unapproved";
		  }
	  }else{
		  $comment_to_approve = $_GET['comment_id'];
		  $comment_status = $_GET['comment'];
		  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_to_approve";
		  $approve_comment = mysqli_query($connection,$query);
		  if($approve_comment){
			  echo "comment approved";
		  }
	  }
	  }
	?>
<table class="table table-bordered table-hover">
	  <thead>
                   <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Respoce to</th>
                        <th>Date</th>
                        <th>Approve</th>
                        <th>Unapprove</th>
						<th>Delete</th>
                    </tr>
                </thead>
				<tbody>
<?php

            $query = "SELECT * FROM comments";
            $select_comments_query = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_comments_query)) {
            $comment_id       = $row['comment_id'];
            $comment_post_id   = $row['comment_post_id'];
			
            $comment_author    = $row['comment_author']; 
            $comment_email       = $row['comment_email'];
            $comment_content        = $row['comment_content'];
            $comment_status        = $row['comment_status'] ; 
            $comment_date          = $row['comment_date']; 
			echo "<tr>";
			echo "<td>{$comment_id}</td>";
			echo "<td>{$comment_author}</td>";
			echo "<td>{$comment_content}</td>";
			echo "<td>{$comment_email}</td>";
			echo "<td>{$comment_status}</td>";
			$query2 = "SELECT * FROM posts WHERE post_id =$comment_post_id";
			$selected_comment_post = mysqli_query($connection, $query2);
			while ($post = mysqli_fetch_assoc($selected_comment_post)){
				$post_id = $post['post_id'];
				$in_responce_to = $post['post_title'];
				echo "<td><a href='../post.php?post_id=$post_id'>$in_responce_to</a></td>";
			}
			echo "<td>{$comment_date}</td>";
			echo "<td><a href='comments.php?comment_id=$comment_id&comment=approve'>Approve</a></td>";
			echo "<td><a href='comments.php?comment_id=$comment_id&comment=unapprove'>Unapprove</a></td>";
			echo "<td><a href='comments.php?comment_id=$comment_id&post_id=$comment_post_id'>Delete</a></td>";
			echo "</tr>";
          }
		  ?>
		  </tbody>
	  </table>

        </div>
		</div>
		</div>
		
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>
		  