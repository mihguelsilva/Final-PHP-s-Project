<?php
if (!isset($_GET['id']) && empty($_GET['id'])) {
    header('location: /index.php');
}
$id = addslashes($_GET['id']);
require_once 'connect.php';
require_once 'classes/ads.php';
require_once 'classes/category.php';
$ads = new Ads();
$category = new Category;
$cat = $category->catchCategory();
$data = $ads->checkProduct($id);
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title><?php echo $data['title']; ?></title>
	<link rel='stylesheet' href='/css/product.css'>
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
	<div class="page-width-photo">
	    <?php
	    if(count($data['photos']) > 0) {
		foreach($data['photos'] as $photo) {
	    ?>
		<div class="box-photo">
		    <img src="ads-images<?php echo DIRECTORY_SEPARATOR . $photo['url']; ?>" width="150" height="150">
		</div>
	    <?php
	    }
	    } else {
	    ?>
		<div class="box-photo">
		    <img src="site-images<?php echo DIRECTORY_SEPARATOR?>no-photo.png" width="150" height="150">
		</div>
	    <?php } ?>
	</div>
	<div class="page-width">
	    <div id="product-data">
		<h1><?php echo $data['title']; ?></h1>
		<p><b>Value</b>: <?php echo number_format($data['value'], 2, ".", "."); ?></p>
		<p><b>Description</b>: <?php echo $data['description'];?></p>
		<p><b>State</b>: <?php echo $data['state']; ?></p>
		<h3>Salesman contact</h3>
		<p><b>Name</b>: <?php echo $data['user_name']; ?></p>
		<p><b>Phone</b>: <?php echo $data['user_phone']; ?></p>
		<p><b>Email</b>: <?php echo $data['user_email']; ?></p>
	    </div>
	</div>
	<script>
	 let divPhoto = document.querySelectorAll('div.box-photo');
	 divPhoto.forEach(function (element, index) {
	     console.log(index);
	     if (element) {
		 if (index % 2 == 0) {
		     element.style.float = "right";
		 }
	     }
	 });
	</script>
    </body>
</html>
