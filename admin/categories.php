<?php include "includes/header.php";?>
    <div id="wrapper">

<?php include "includes/navigation.php";?>
		

        <div id="page-wrapper">
		<?php delete_categories();?>

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome To Admin Area
                            <small>Author</small>
                        </h1>
						<div class="col-xs-6">
            
            <?php insert_categories()?>
    
    <form action="" method="post">
      <div class="form-group">
         <label for="cat-title">Add Category</label>
          <input type="text" class="form-control" name="cat_title" autocomplete="off">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
      </div>

    </form>
	 <form action="" method="post">
      <div class="form-group">
	  <?php if(isset($_GET['update'])){
		 $cat_id = $_GET['update'];
		 $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
		 $get_category = mysqli_query($connection,$query);
		 if($result = mysqli_fetch_assoc($get_category)){
			$get_cat_title = $result['cat_title'];
		 }
		}
		if(isset($_POST['update-category'])){
			$update_categeory_title = $_POST['cat_title'];
		  $query = "UPDATE categories SET cat_title = '{$update_categeory_title}' WHERE cat_id = {$cat_id}";
		  $save_updated_category = mysqli_query($connection,$query );
		  if($save_updated_category){
			  echo "Category updated";
		  }
		  $get_cat_title = "";
		}?>
		<br>
         <label for="cat-title">Edit Category</label>
          <input type="text" class="form-control" name="cat_title" autocomplete="off" value="<?php if(isset($get_cat_title)) echo $get_cat_title;?>">
      </div>
       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="update-category" value="Update Category">
      </div>

    </form>
	
	
	
	
                    </div>
					
		 <div class="col-xs-6">
    <table class="table table-bordered table-hover">
      

        <thead>
            <tr>
                <th>Id</th>
                <th>Category Title</th>
				<th>Delete</th>
				<th>Update</th>
            </tr>
        </thead>
        <tbody>

        <?php 


    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_categories)) {
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<tr>";
        
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
	echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
	echo "<td><a href='categories.php?update={$cat_id}'>Update</a></td>";
    echo "</tr>";

    }




?>
        

      

        </tbody>
    </table>			
					
					
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php";?>