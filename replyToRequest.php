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
		"UPDATE
		game
		SET
		state = 1
		WHERE
		id =?"
		);

	$statement->bindParam(1, $id);
	$statement->execute();

	echo "Ok ! Hra byla prijata. Nyni ceka na inicializaci.";
	}
else{
	$statement = $pdo->prepare(
		"DELETE FROM gameRequests
		where id = ?"
		);
	$statement->bindParam(1, $id);
	$statement->execute();
	echo "Ok ! Hra byla odmitnuta.";
	}

header( "refresh:4;url=newgame.php" );
exit(0);

?>
