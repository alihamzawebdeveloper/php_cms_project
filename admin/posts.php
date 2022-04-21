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
                            Posts Area
                            <small>Author</small>
                        </h1>
						<div class="col-xs-12">
            
     
				<?php 
			if(isset($_GET['source'])){
				$source = $_GET['source'];
				
			}else{
				$source = '';
			}
			switch($source){
			 case 'add_posts';
            include "includes/add_posts.php";
             break;	
	         case 'edit_post';
            include "includes/edit_post.php";
             break;			 
			 case 'delete_post';
            include "includes/delete_post.php";
             break;
			 default:
             include "includes/view_all_posts.php";
             break;
			}
		  ?>
				