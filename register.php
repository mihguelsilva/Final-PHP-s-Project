<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Register New User</title>
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
	<section id="form">
	    <form method="POST">
		<h2>Register New User</h2>
		<label for="name">Name</label>
		<input type="text" name="name" autocomplete="off" id="name" maxlength="50">
		<label for="phone">Phone</label>
		<input type="text" name="phone" autocomplete="off" id="phone" maxlength="30">
		<label for="email">Email</label>
		<input type="email" name="email" autocomplete="off" id="email" maxlength="40">
		<label for="password">Password</label>
		<input type="password" name="password" autocomplete="off" id="password" maxlength="20">
		<label for="confirm-password">Confirm Password</label>
		<input type="password" name="confirm-password" autocomplete="off" id="confirm-password" maxlength="20">
		<input type="submit" name="register" value="Register" id="button">
	    </form>
	</section>
    </body>
</html>
