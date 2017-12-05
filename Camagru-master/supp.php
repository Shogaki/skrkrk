<?php
require_once("config/isConnected.php");
require_once("config/connect-db.php");
if (!isset($_GET['post']))
{
	header('Location: index.php');
	exit();
}
$id_post = $_GET['post'];
$reponse = $bdd->query('SELECT `id-proprio` FROM `photo` WHERE `id` = ' . $id_post);
$check = $reponse->fetch();
$id_auteur = ($check['id-proprio']);

$reponse = $bdd->query('SELECT `id` FROM `user` WHERE `login` = \'' . $_SESSION['login'] . '\'');
$check = $reponse->fetch();
$id_user = ($check['id']);

//echo("POST: " . $id_post . "<br>AUTEUR: " . $id_auteur . "<br>USER: " . $id_user);
if ($id_auteur == $id_user)
	$bdd->query('DELETE FROM photo WHERE `id-proprio` = "'.$id_user.'" AND id = "'.$id_post.'"');
header('Location: index.php');
?>