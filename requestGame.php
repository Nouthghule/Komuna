<?php
ob_start();
session_start();

if(!isset($_POST['targetNick'])){
	echo "Prosim zadej nick druheho hrace.";
	header( "refresh:4;url=newgame.php" );
	}
$targetNick = $_POST['targetNick'];
$nick = $_SESSION['nick'];

if($targetNick == $_SESSION['nick']){
	echo "Pardon, ale s timhle jsem nepocital. Pokad chces fakt hrat sam(a) proti sobe, tak si zaloz dalsi ucet.";
	header( "refresh:4;url=newgame.php" );
	exit(0);
	}

$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$statement = $pdo->prepare(
	"SELECT
		nick
	FROM
		users
	WHERE
		nick = ?"
	);

$statement->bindParam(1, $targetNick);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_OBJ);
if(!$result){
	echo "Zadany uzivatel ($targetNick) (bez zavorek) nebyl nalezen.<br>Budto si over, jakou ma prezdivku, nebo ho dokopej k tomu, at se zaregistruje.<br>Nebo ne, jak chces.";
	header( "refresh:4;url=newgame.php" );
	exit(0);
	}

$statement = $pdo->prepare(
	"INSERT INTO 
	gameRequests
	(sender, recipient, player1, player2, state)
	VALUES
	(?,?,?,?,?)"
	);

$startState = 0;
$statement->bindParam(1, $nick);
$statement->bindParam(2, $targetNick);
$statement->bindParam(5, $startState);
if($_POST['senderSide']==1){
	$statement->bindParam(3, $nick);
	$statement->bindParam(4, $targetNick);
	}
else{
	$statement->bindParam(4, $nick);
	$statement->bindParam(3, $targetNick);
	}

$statement->execute();

echo "Ok ! Nabidka hry odeslana.";
if($nick===$targetNick){
	echo "\nPoslal jsi nabidku sam sobe. Snad jsi chtel presne to.";
	}
header( "refresh:4;url=newgame.php" );
exit(0);

?>
