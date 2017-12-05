<?php

require_once("config/isConnected.php");
require_once("config/connect-db.php");


$dir = "resources/img/";
$dest = "generated/";

if ($_FILES['webcamFile']['name'] == "" && $_FILES['image']['name'] == "")
	header('Location: cam.php?err=1');

// VERIFIER QUE L'IMAGE QUE L'USER ENVOIS EST BIEN UN JPG/JPEG SINON RENVOIS AVEC ERREUR
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

$type = ($_FILES['image']['name'] == "") ? "webcamFile" : "image";

$img1 = imagecreatefrompng($dir.$_POST['overlay']);
$img2 = imagecreatefromjpeg($_FILES[$type]['tmp_name']);

imagecolortransparent($img1, imagecolorat($img1, 0, 0));

$src_x = imagesx($img1);
$src_y = imagesy($img1);

imagecopymerge($img2, $img1, 0, 0, 0, 0, $src_x, $src_y, 100);
$name = $dest.$_SESSION['login']."-".time().".png";
$test = imagepng($img2, $name, 0);

imagedestroy($img1);
imagedestroy($img2);


// RETOURNER L'UTILISATEUR SUR UNE PAGE POUR QU'IL VOIT LE RESULTAT
$reponse = $bdd->query(' SELECT `id`FROM `user` WHERE `login` = \'' . $_SESSION['login'] . '\'');
$check = $reponse->fetch();
$id = ($check['id']);
$reponse = $bdd->query('INSERT INTO photo(`id-proprio`, `url photo`) VALUES ( '. $id .',\'' .  $name . '\')');
echo "<script>setTimeout(function(){ window.location.href = 'image.php';}, 5000);</script>"
?>