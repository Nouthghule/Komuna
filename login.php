<?php
ob_start();
if(($_POST['login']=="")||($_POST['password']=="")){
	echo 'Prosim, vypln jak login, tak heslo.';
	exit(0);
	}


$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM users WHERE login=?');
$statement->bindParam(1, $_POST['login']);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_OBJ);

if(!($user)){
	echo 'Uzivatel nenalezen. Budto jsi spatne zadal(a) login, nebo neexistujes. (Nebo mozna oboji, ale nad tim se mi nechce premyslet.) <br> Zkus to <a href="komuna.php">znova</a>.';
	exit(0);
	}

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$passwordCorrect = password_verify($_POST['password'], $user->password);

if($passwordCorrect){
	session_start();
	$_SESSION['user'] = $user->login;
	$_SESSION['nick'] = $user->nick;
	header("Refresh:0; url=komuna.php");
	}
else{
	echo 'Nespravne heslo.<br> Zkus to <a href="komuna.php">znova</a>.';
	exit(0);
	}



?>
