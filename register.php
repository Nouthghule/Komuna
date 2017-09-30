<?php header("X-Clacks-Overhead: GNU Terry Pratchett"); ?> 
<?php

if(($_POST['login']=="")||($_POST['nick']=="")||($_POST['password']=="")){
	echo 'Tak takhle to nepujde. <br /> Vrat se <a href="register.html">zpatky</a> a vypln mi vsechny kolonky.';
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
$dupeLogin = $statement->fetch(PDO::FETCH_ASSOC);
$statement = $pdo->prepare('SELECT * FROM users WHERE nick=?');
$statement->bindParam(1, $_POST['nick']);
$statement->execute();
$dupeNick = $statement->fetch(PDO::FETCH_ASSOC);


if($dupeNick||$dupeLogin){
	echo "Registrace se nezdarila :";
	if($dupeLogin){
		echo "<br>Jiz existuje uzivatel s vybranym loginem. Vyber si prosim jiny.";
		}
	if($dupeNick){
		echo "<br>Jiz existuje uzivatel s vybranym nickem. Vyber si prosim jiny.";
		}
	echo '<br> <a href="register.html">Zpatky</a>';
	exit(0);
	}


$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);



$statement = $pdo->prepare("INSERT INTO users (login, password, nick) 
	      VALUES
	      (?,?,?)");
$statement->bindParam(1, $_POST['login']);
$statement->bindParam(2, $hash);
$statement->bindParam(3, $_POST['nick']);
$statement->execute();

echo "Registrace se zdarila. Nyni se muzes prihlasit. ";
echo '<br /> <a href="komuna.php">Zpatky na komunu</a>';

?>
