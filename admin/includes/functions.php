<?php
function confirmQuery($query){
	global $connection;
	if($query){
		   echo 'Operation Successfull';
	   }
}
function insert_categories(){
	global $connection;
	if(isset($_POST['submit'])){

            $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)) {
        
             echo "This Field should not be empty";
    
			} else {
				$query = "INSERT INTO categories(cat_title) VALUES('{$cat_title}')";
				$add_catgory = mysqli_query($connection,$query);
				if(!$add_catgory){
					echo "Query Failed";
				}
			}}	
}
function delete_categories(){
	    global $connection;
        if(isset($_GET['delete'])){
		 $cat_id = $_GET['delete'];
		 $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
		 $delete_category = mysqli_query($connection,$query);
		 if(!$delete_category){
			 echo "query failed";
		 }
		}
	
}

?>