<?php include('inc/header.php') ?>
<?php 

require_once("config/isConnected.php");
require_once("config/connect-db.php");

?>

<!DOCTYPE html>
<html>
<head>
			<link rel="stylesheet" type="text/css" href="resources/css/nikleskeuf.css">

	<title>Camagru</title>
</head>
<body>
	<div id="header">
		<p>
			CAMAGRU, BIENVENUE <?= $_SESSION['login']; ?>
			<br>
		</p>
	</div>
	<div id="main">
	<?php 
	$reponse = $bdd->query('SELECT `id-proprio` AS "login" , `id` , `url photo` AS "photo" FROM `photo`');
	while ($check = $reponse->fetch()) { 
		$login = $check["login"];
		$photo = $check["photo"];
	?>

	 <div class="gallery">
	 	<a href="image.php?id=<?= $check['id'] ?>">
		  	<div class="divimage">
    			<img class="pute" src='<?= $check['photo'] ?>'>
  			</div>
	 		<div class="desc"><?= $login ?></div>
	 	</a>
	 </div>


	<?php } ?>



	</div>
</body>
</html>