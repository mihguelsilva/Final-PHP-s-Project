<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Login</title>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap' rel='stylesheet'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="/css/login.css">
	<script src='/js/nav_menu.js'></script>
    </head>
    <body>

	<?php
	require_once 'connect.php';
	require_once 'classes/user.php';
	$user = new User();
	if (isset($_POST['email']) && isset($_POST['password'])) {
	    $email = addslashes($_POST['email']);
	    $password = addslashes($_POST['password']);
	    if (!empty($email) && !empty($password)) {
		$password = md5($password);
		if ($user->signin($email, $password)) {
		    header('location: /index.php');
		} else {
		    echo "<script>window.alert('Incorrect credentials!');</script>";
		}
	    } else {
		echo "<script>window.alert('Incorrect credentials!');</script>";
	    }
	}
	?>
	
	<section id="form">
	    <form method="POST">
		<h2>Sign In</h2>
		<input type="email" name="email" placeholder="Username" autocomplete="off">
		<input type="password" name="password" placeholder="Password" autocomplete="off">
		<input type="submit" name="login" value="Login" id="button">
		<a href="/register.php">Register new user</a>
	    </form>
	</section>
    </body>
</html>
