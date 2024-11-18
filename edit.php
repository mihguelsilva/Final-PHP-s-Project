<?php
require_once 'connect.php';
require_once 'classes/ads.php';
if (empty($_SESSION['login'])) {
    header('location: /login.php');
    exit();
}
$ads = new Ads();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);
    $data = $ads->editAds($id);
}
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Edit ADS</title>
	<link rel='stylesheet' href='/css/edit.css'>
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
	<form method="POST" enctype="multipart/form-data">
	    <h1>Edit ADS</h2>
		<label for="title">Title</label>
		<input type="text" id="title" name="title" autocomplete="off" value="<?php echo $data['title']; ?>">
		<label for="description">Description</label>
		<textarea id="description" name="description"><?php echo $data['description'];?></textarea>
		<label for="value">Value</label>
		<input type="text" id="value" name="value" placeholder="00,00" value="<?php echo "R$ ".number_format($data['value'], 2); ?>">
		<label for="category">Category</label>
		<select id="category" name="category">
		    <?php
		    require_once 'classes/category.php';
		    $category = new Category();
		    $cat = $category->catchCategory();
		    foreach($cat as $categ) {
			if ($categ['id_category'] == $data['fk_id_category']) {
			    echo "<option value='".$categ['id_category']."' selected='selected'>".$categ['name']."</option>";
			} else {
			    echo "<option value='".$categ['id_category']."'>".$categ['name']."</option>";
			}
		    }
		    ?>
		</select>
		<label for="state">State</label>
		<select id="state" name="state">
		    <?php
		    $stateValue = array('new', 'used', 'pre-owned');
		    foreach($stateValue as $state) {
			if ($state == $data['state']) {
			    echo "<option value='".$state."' selected='selected'>".ucfirst($state)."</option>";
			} else {
			    echo "<option value='".$state."'>".ucfirst($state)."</option>";
			}
		    }
		    ?>
		</select>
		<label for="photos">Photos</label>
		<input type="file" id="photos" name="photos[]" multiple>
		<input type="submit" name="save" value="Save">
		<div id="box-photos">
		    <header>
			ADS's Photos
		    </header>
		    <!--
			 <figure class="content">
			 <img src="/site-images/no-photo.png" width="100px">
			 <figcaption><a href="">Delete</a></figcaption>
			 </figure>
			 <figure class="content">
			 <img src="/site-images/no-photo.png" width="100px">
			 <figcaption><a href="">Delete</a></figcaption>
			 </figure>
			 <figure class="content">
			 <img src="/site-images/no-photo.png" width="100px">
			 <figcaption><a href="">Delete</a></figcaption>
			 </figure>-->
		    <?php
		    if (isset($data['photos'])) {
			foreach($data['photos'] as $photo) {
		    ?>
			<figure class="content">
			    <img src="ads-images<?php echo DIRECTORY_SEPARATOR.$photo['url'];
						?>" width="100px" height="100px">
			    <figcaption><a href="/edit.php?id=<?php echo $data['id_announcements']?>
						 &idm=<?php echo $photo['id_image'] ?>">Delete</a></figcaption>
			</figure>
		    <?php
		    }
		    }
		    ?>
		</div>
	</form>
    </body>
</html>
<?php
if (isset($_GET['idm']) && !empty($_GET['idm']) && isset($_GET['id']) && !empty($_GET['id'])) {
    $idm = addslashes($_GET['idm']);
    $id = addslashes($_GET['id']);
    $ads->deletePhoto($idm);
    echo "<script>window.location.href='/edit.php?id=".$_GET['id']."';</script>";
}
?>
