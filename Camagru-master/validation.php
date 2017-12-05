<?php
session_start();
require_once("config/connect-db.php");
$password = hash('whirlpool', htmlspecialchars($_POST["mdp"]));
$mail = htmlspecialchars($_POST['miel']);
$sujet = 'Felissitassion bb';
		$message = '<html>';
		$message .= '<head><title> Felicitation ton compte a bien été créeé ! </title></head>';
		$message .= '<p>Bonjour, <br> Felicitation ton compte a bien été créeé ! </p>';
		$message .= '</html>';
		$headers = 'MIME-Version: 1.0'."\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		$headers .= 'From: "Camagru"<nepasrepondre@camagru.fr>'."\n";
		mail($mail, $sujet, $message, $headers);

//VERIFICATION DISPONIBILITE PSEUDO
$pseudo = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['miel']);
$passwd = htmlspecialchars($_POST['mdp']);

$reponse = $bdd->query('SELECT count(login) AS nb FROM user WHERE login =\'' . $pseudo . '\'');
$pseudo_check = $reponse->fetch();

if ($pseudo_check['nb'] != 0)
{
	echo "Le pseudo " . $pseudo . " n'est pas disponible<br>";
	exit();
}

//VERIFICATION VALIDITE EMAIL

if (!filter_var($email, FILTER_VALIDATE_EMAIL) !== FALSE)
{
	echo "L'adresse e-mail " . $email . " est incorrecte<br>";
	exit();
}

//VERIFICATION DISPONIBILITE EMAIL
$reponse = $bdd->query('SELECT count(*) AS nb FROM user WHERE email=\'' . $email . '\'');
$email_check = $reponse->fetch();

if ($email_check['nb'] < 0)
{
	echo "L'adresse e-mail " . $email . " n'est pas disponible<br>";
	exit();
}

//VERIFICATION LONGUEUR MOT DE PASSE

if (strlen($passwd) < 6)
{
	echo "Le mot de passe est trop court (6 caracteres minimum)<br>";
	exit();
}

//VERIFICATION COMPLEXITE MOT DE PASSE

if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $passwd))
{
	echo "Le mot de passe n'est pas assez complexe, il doit contenir au minimum une majuscule, une minuscule et un chiffre.<br>";
	exit();
}

//CREATION DES DOSSIERS UTILISATEUR
$var = $bdd->query('INSERT INTO `user`(`login`, `email`, `mdp`) VALUES (\'' . $pseudo . '\', \''. $email . '\', \'' .  $password . '\')');

//mkdir("post/" . $pseudo);
?>
