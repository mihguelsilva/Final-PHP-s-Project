<?php
require_once 'connect.php';
require_once 'classes/ads.php';
require_once 'classes/category.php';
$ads = new Ads();
$data = $ads->catchProduct();
$category = new Category();
$cat = $category->catchCategory();
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>Project</title>
	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap' rel='stylesheet'>
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
	<link rel="stylesheet" href="/css/main-page.css">
    </head>
    <body>
	<header>
	    <div class="page-width">
		<h1>Advertise Here</h1>
		<h2>Quick and easy sell.</h2>
		<figure>

		    <?php
		    if (isset($_SESSION['login'])) {
			echo "<a href='/logout.php'>";
			echo "<figure>";
			echo '<img src="/site-images/perfil.png" alt="images user perfil" width="100%">';
			echo '<figcaption>Sign out</figcaption>';
			echo "</figure>";
			echo "</a>";
		    } else {
			echo "<a href='/login.php'>";
			echo "<figure>";
			echo '<img src="/site-images/perfil.png" alt="images user perfil" width="100%">';
			echo '<figcaption>Sign in</figcaption>';
			echo "</figure>";
			echo "</a>";
		    }
		    ?>
		</figure>
	    </div>
	</header>
	<nav id="menu">
	    <div class="page-width">
		<div id="sites-name">
		    <a href="/index.php"><h2>SITE'S NAME</h2></a>
		</div>
		<div id="links">
		    <ul>
			<?php
			if (isset($_SESSION['login'])) {
			    echo '<li><a href="/my-ads.php">My ADS</a></li>';
			} else {
			    echo '<li><a href="/login.php">Advertise</a> </li>';
			}
			?>
			<li><a href="">Contact</a></li>
			<li><a href="">About us</a></li>
		    </ul>
		</div>
	    </div>
	</nav>
	<section>
	    <div class="page-width">
		<?php
		foreach($data as $d) {
		?>
		    <div class="box">
			<a href="/product.php?id=<?php echo $d['id_announcements']; ?>">
			<?php
			if (isset($d['url'])) {
			?>
			    <img src="ads-images<?php echo DIRECTORY_SEPARATOR. $d['url'] ?>">
			<?php
			} else {
			?>
			    <img src="site-images<?php echo DIRECTORY_SEPARATOR ."no-photo.png" ?>">
			<?php
			}
			?>
			    <hgroup>
				<h3><?php echo $d['title']; ?></h3>
				<h5><?php
				    foreach($cat as $c) {
					if ($c['id_category'] == $d['fk_id_category']) {
					    echo $c['name'];
					}
				    }
				    ?></h5>
				<h4><?php echo "RS " . $d['value']; ?></h4>
			    </hgroup>
			</a>
		    </div>
		<?php
		}
		?>
	    </div>
	</section>
    </body>
</html>
