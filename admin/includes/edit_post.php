<?php
if(isset($_GET['post_id'])){
	$post_id = $_GET['post_id'];
	
    $query = "SELECT * FROM posts WHERE post_id = $post_id  ";
    $select_posts_by_id = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id            = $row['post_id'];
        $post_author        = $row['post_author'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_img'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date'];
        
	}

	
}
if(isset($_POST['update_post'])){
	$post_category_id = $_POST['post_category_id'];
	$post_title = $_POST['post_title'];
	$post_author =  $_POST['post_author'];
	$update_post_image = $_FILES['image']['name'];
	$update_temp_post_image = $_FILES['image']['tmp_name'];
	if($update_post_image == ''){
		$update_post_image = $post_image;
	}
	$post_content = $_POST['post_content'];
	$post_tags = $_POST['post_tags'];
	$post_status = $_POST['post_status'];
	move_uploaded_file($update_temp_post_image, "../images/$update_post_image");
	$query = "UPDATE posts SET post_category_id = '{$post_category_id}', post_title = '{$post_title}', post_author = '{$post_author}', post_date = now(), post_img = '{$update_post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}' WHERE post_id = $post_id";
    $update_post = mysqli_query($connection,$query);
	if($update_post){
		echo "<div class='alert alert-success'>";
        echo "<strong>Success!</strong> Post Updated Successfully.";
        echo  "</div>";
	}
}

?>
<form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input value="<?php echo $post_title;?>" type="text" class="form-control" name="post_title">
      </div>

         <div class="form-group">
       <label for="category">Post Category</label><br>
       <select name="post_category_id" class="form-control">
	   <?php
	   $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
	if($cat_id == $post_category_id){
		$selected = "selected";
	}else{
		$selected = "";
	}
	echo "<option $selected value='{$cat_id}'>{$cat_title}</option>";
	}
	   ?>
	   </select>
      </div>
      <div class="form-group">
         <label for="title">Post Author</label>
          <input value="<?php echo $post_author;?>" type="text" class="form-control" name="post_author">
      </div>
      
      

       <div class="form-group">
         <label for="title">Post Status</label>
          <select name="post_status" class="form-control">
		  <?php
		  if($post_status == 'Published'){
			  echo "<option selected='true' value='Published'>Published</option>";
			  echo "<option value='Draft'>Draft</option>";
		  }else{
			  echo "<option value='Draft'>Draft</option>";
			  echo "<option value='Published'>Published</option>";
		  }
		  ?>
		  
		  </select>
      </div>
      
      
      
    <div class="form-group">
		 <label for="post_image">Post Image</label><br>
		 old image:
		 <img width="100" src="../images/<?php echo $post_image?>">
          <input  type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="editor" cols="30" rows="10"><?php echo $post_content;?>
         </textarea>
      </div>
      <script src="js/scripts.js">
    </script>
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
      </div>


</form>