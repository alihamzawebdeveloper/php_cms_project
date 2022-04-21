<?php
if(isset($_POST['checkboxes'])){
	$post_publish = false;
	$post_draft   = false;
	$post_delete  = false;
	$create_post_query = false;
	foreach($_POST['checkboxes'] as $postValue){
	$bulk_option = $_POST['bulk_options'];
	switch($bulk_option){
		case 'published';
		$query = "UPDATE posts SET post_status = 'Published' WHERE post_id = {$postValue}";
		$post_publish = mysqli_query($connection, $query);
		
		break;
		case 'draft';
		$query = "UPDATE posts SET post_status = 'Draft' WHERE post_id = {$postValue}";
		$post_draft = mysqli_query($connection, $query);
		
		break;
		case 'delete';
		$query = "DELETE FROM posts WHERE post_id = {$postValue}";
		$post_delete = mysqli_query($connection, $query);
		
		break;
		case 'clone';
		$query = "SELECT * FROM posts WHERE post_id = {$postValue}";
		$select_post_query = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_array($select_post_query)) {
            $post_id       = $row['post_id'];
            $post_author   = $row['post_author'];
            $post_title    = $row['post_title']; 
            $post_category_id        = $row['post_category_id'];
            $post_status        = $row['post_status'];
            $post_image         = $row['post_img'] ; 
            $post_tags          = $row['post_tags']; 
			$post_content       = $row['post_content'];
            $post_comment_count       = $row['post_comment_count'];
            $post_date  = $row['post_date'];
		}
		$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date,post_img,post_content,post_tags,post_status) ";
             
      $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 
             
      $create_post_query = mysqli_query($connection, $query);  
	  
		break;
	}
	}
	if($post_publish){
			echo "<div class='alert alert-success'>";
            echo "<strong>Published!</strong> Selected post(s) are published successfully";
            echo  "</div>";
		}
	if($post_draft){
			echo "<div class='alert alert-success'>";
            echo "<strong>Draft!</strong> Selected post(s) went in draft successfully";
            echo  "</div>";
		}	
	if($post_delete){
			echo "<div class='alert alert-danger'>";
            echo "<strong>Delete!</strong> Selected post(s) deleted successfully";
            echo  "</div>";
		}
	if($create_post_query){
		echo "<div class='alert alert-success'>";
        echo "<strong>Success!</strong> Selected post(s) cloned successfully";
        echo  "</div>";
	}	
}
?>
<form action="" method="post">
 <table class="table table-bordered table-hover">
       <div id="bulkOptionContainer" class="col-xs-4">

        <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
		<option value="clone">Clone</option>
        </select>

        </div> 

            
<div class="col-xs-4">

<input type="submit" name="submit" class="btn btn-success" value="Apply">
<a class="btn btn-primary" href="posts.php?source=add_posts">Add New</a>

 </div>
         
 
	  <thead>
                   <tr>
                        <th><input type="checkbox" id="selectAllBox"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
						<th>Views</th>
						<th>View</th>
						<th>Edit</th>
						<th>Delete</th>
                    </tr>
                </thead>
				<tbody>
<?php

$query = "SELECT * FROM posts";
            $select_post_query = mysqli_query($connection, $query);


          
            while ($row = mysqli_fetch_array($select_post_query)) {
            $post_id       = $row['post_id'];
            $post_author   = $row['post_author'];
            $post_title    = $row['post_title']; 
            $post_category_id        = $row['post_category_id'];
            $post_status        = $row['post_status'];
            $post_image         = $row['post_img'] ; 
            $post_tags          = $row['post_tags']; 
            $post_comment_count       = $row['post_comment_count'];
			$post_view_count = $row['post_view_count'];
            $post_date  = $row['post_date'];
			echo "<tr>";
			?>
			<td><input class="checkboxes" type="checkbox" name="checkboxes[]" value="<?php echo $post_id?>"></td>
			<?php
			echo "<td>{$post_id}</td>";
			echo "<td>{$post_author}</td>";
			echo "<td>{$post_title}</td>";
			$query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
		    $get_category = mysqli_query($connection,$query);
		    if($result = mysqli_fetch_assoc($get_category)){
			$get_cat_title = $result['cat_title'];
		 }
			
			echo "<td>{$get_cat_title}</td>";
			echo "<td>{$post_status}</td>";
			echo "<td><img width=100 src='../images/{$post_image}'</td>";
			echo "<td>{$post_tags}</td>";
			echo "<td>{$post_comment_count}</td>";
			echo "<td>{$post_date}</td>";
			echo "<td>{$post_view_count}</td>";
			echo "<td><a href='../post.php?post_id={$post_id}'>View</a></td>";
			echo "<td><a href='posts.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
			echo "<td><a onclick =\"javascript: return confirm('Are you sure you want to delete?'); \"href='posts.php?source=delete_post&post_id={$post_id}'>Delete</a></td>";
			echo "</tr>";
          }
		  ?>
		  </tbody>
	  </table>
      </form>
        </div>
		</div>
		</div>
		
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>
		  