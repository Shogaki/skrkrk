<?php 

require_once("config/isConnected.php");
require_once("config/connect-db.php");

$login = htmlspecialchars($_POST['login']); 
$password = hash('whirlpool', htmlspecialchars($_POST["mdp"]));


$req = $bdd->query('SELECT count(*) FROM user WHERE login = "'.$login.'" AND mdp = "'.$password.'"');
$req = $req->fetch();

if ($req[0] == "1") // L'utilisateur est trouvé, connexion
{
	session_start();
	$_SESSION['login'] = $login;
	header('Location: index.php?success=1');
}
else // Pas d'utilisateur trouvé, erreur
{
	header('Location: connexion.php?error=2');
}

?>
