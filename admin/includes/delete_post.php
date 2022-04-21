<?php

if(isset($_GET['post_id'])){
	$post_id = $_GET['post_id'];
	$query = "DELETE FROM posts WHERE post_id = $post_id";
	$delete_post = mysqli_query($connection,$query);
	if($delete_post){
		echo "Post has been deleted. <a href='posts.php'>Go back to posts</a>";
	}
	
}


?>