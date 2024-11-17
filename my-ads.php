<?php
require_once 'connect.php';
require_once 'classes/ads.php';
if (empty($_SESSION['login'])) {
    header('location: /login.php');
    exit();
}
$ads = new Ads();
$data = $ads->catchAds();
?>
<!DOCTYPE html>
<html lang='pt-br'>
    <head>
	<meta charset='utf-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<title>My ADS</title>
	<link rel="stylesheet" href="/css/my-ads.css">
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
	<div id="table-body">
	    <h2>My ADS</h2>
	    <a href="/add-ads.php">Add Ads</a>
	    <table>
		<thead>
		    <td>Photo</td>
		    <td>Title</td>
		    <td>Value</td>
		    <td>State</td>
		    <td>Category</td>
		    <td>Action</td>
		</thead>
		<?php
		foreach($data as $d) {
		    echo "<tr>";
		    if ($d['url']) {
			echo '<td><img src="ads-images' . DIRECTORY_SEPARATOR . $d['url'] . '" height="80" width="90"></td>';
		    } else {
			echo '<td><img src="site-images'.DIRECTORY_SEPARATOR .'no-photo.png" height="80" width="90"></td>';
		    }
		    echo "<td>" . $d['title'] . "</td>";
		    echo "<td>R$ " . number_format($d['value'], 2, ",", ".") . "</td>";
		    echo "<td>" . $d['state'] . "</td>";
		    echo "<td>" . $d['category_name'] . "</td>";
		    echo '<td>
			<a href="/edit.php">Edit</a>
			<a href="">Remove</a>
		    </td>';
		    echo "</tr>";
		}
		?>
	    </table>
	</div>	
    </body>
</html>
