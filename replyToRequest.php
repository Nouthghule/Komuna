<?php
ob_start();
session_start();

$id = $_POST['id'];
$rep= $_POST['rep'];
$nick = $_SESSION['nick'];


$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$statement = $pdo->prepare(
	"SELECT
		player1, player2, recipient
	FROM
		gameRequests
	WHERE
		id = ?"
	);

$statement->bindParam(1, $id);
$statement->execute();
$result = $statement->fetch(PDO::FETCH_OBJ);
if(!$result){
	echo "request not found";
	header( "refresh:4;url=newgame.php" );
	exit(0);
	}

if(!($nick===$result->recipient)){
	echo "pokusil jsi se prijmout cizi request. Zamita se.";
	exit(0);
	}

if($rep){
	$statement = $pdo->prepare(
		"INSERT INTO 
		games
		(player1, player2, result, sentMove, lastMove, turnNum, activePlayer, movesLeft)
		VALUES
		(?,?,?,?,?,?,?,?)"
		);

$x = 0;
$p1 = $result->player1;
$p2 = $result->player2;
$statement->bindParam(1, $p1);
$statement->bindParam(2, $p2);
$statement->bindParam(3, $x);
$statement->bindParam(4, $x);
$statement->bindParam(5, $x);
$statement->bindParam(6, $x);
$statement->bindParam(7, $x);
$statement->bindParam(8, $x);
$statement->execute();
	}


$statement = $pdo->prepare(
	"DELETE FROM gameRequests
	where id = ?"
	);
$statement->bindParam(1, $id);
$statement->execute();

if($rep){
echo "Ok ! Hra byla prijata. Najdes ji v sekci rozehrane hry.";
}
else{
echo "Ok ! Hra byla odmitnuta.";
	}
header( "refresh:4;url=newgame.php" );
exit(0);

?>
