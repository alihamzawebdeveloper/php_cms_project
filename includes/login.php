<?php
session_start();
include 'db.php';
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$username = mysqli_real_escape_string($connection,$username);
	$password = mysqli_real_escape_string($connection,$password);
	echo $password;
	$query = "SELECT * FROM users WHERE username = '{$username}'";
	$get_user = mysqli_query($connection,$query);
	while($user = mysqli_fetch_assoc($get_user))
	{
		$db_user_id = $user['user_id'];
		$db_username = $user['username'];
		$db_user_password = $user['user_password'];
		$dp_user_firstname = $user['user_firstname'];
		$dp_user_lastname = $user['user_lastname'];
		$dp_user_role = $user['user_role'];
	}
	if(password_verify($password,$db_user_password)){
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $dp_user_firstname;
		$_SESSION['lastname'] = $dp_user_lastname;
		$_SESSION['user_role'] = $dp_user_role;
		header('Location: ../admin');
	}else{
		header('Location: ../index.php');
	}
	
}
?>