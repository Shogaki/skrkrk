<?php 
require_once("config/isConnected.php");
require_once("config/connect-db.php");

$photo = $_POST['image'];
$text = $_POST['com'];
$reponse = $bdd->query(' SELECT `id`FROM `user` WHERE `login` = \'' . $_SESSION['login'] . '\'');
$check = $reponse->fetch();
$user = ($check['id']);
echo($photo . $text . $user);
$reponse = $bdd->query('INSERT INTO `komentair`(`id-user`, `id-photo`, `chankometair`) VALUES (' . $user . ' ,' . $photo . ', \'' .  $text . '\')')
 ?>