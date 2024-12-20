<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Add ADS</title>
	<link rel='stylesheet' href='/css/add-ads.css'>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap' rel='stylesheet'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<script src='/js/nav_menu.js'></script>
    </head>
    <body>
	<?php
	require_once 'connect.php';
	require_once 'classes/ads.php';
	require_once 'classes/category.php';
	$catchCat = new Category();
	$ads = new Ads();
	if (!isset($_SESSION['login'])) {
	    header('location: /index.php');
	    exit();
	}
	if (isset($_FILES['photos']) && !empty($_FILES['photos'])) {
	    $photos = $_FILES['photos'];
	} else {
	    $photos = array();
	}
	if (isset($_POST['title'])) {
	    $title = addslashes($_POST['title']);
	    $description = addslashes($_POST['description']);
	    $value = addslashes($_POST['value']);
	    $category = addslashes($_POST['category']);
	    $state = addslashes($_POST['state']);
	    if (!empty($title) &&
		!empty($description) &&
		!empty($value) &&
		!empty($category) &&
		!empty($state)) {
		$ads->addAds($title, $description, $value, $category, $state, $photos);
		header('location: /my-ads.php');
	    } else {
		echo "<script>window.alert('You must fill in all fields!');</script>";
	    }
	}
	?>
	<form method="POST" enctype="multipart/form-data">
	    <h1>Add ADS</h2>
		<label for="title">Title</label>
		<input type="text" id="title" name="title" autocomplete="off" maxlength="15">
		<label for="description">Description</label>
		<textarea id="description" name="description" maxlength="2000"></textarea>
		<label for="value">Value</label>
		<input type="text" id="value" name="value" placeholder="00,00">
		<label for="category">Category</label>
		<select id="category" name="category">
		    <?php
		    $data = $catchCat->catchCategory();
		    if (count($data) > 0) {
			foreach($data as $d) {
			    echo "<option value='" . $d['id_category'] . "'>" . $d['name'] . "</option>";
			}
		    }
		    ?>
		</select>
		<label for="state">State</label>
		<select id="state" name="state">
		    <option value="new">New</option>
		    <option value="used">Used</option>
		    <option value="pre-owned">Pre-Owned</option>
		</select>
		<label for="photos">Photos</label>
		<input type="file" id="photos" name="photos[]" multiple>
		<input type="submit" name="add" value="Add">
		<!-- <div id="box-photos">
		     <header>
		     ADS's Photos
		     <img src="/site-images/no-photo.png" width="170px">
		     </header>
		     </div>-->
	</form>
    </body>
</html>
