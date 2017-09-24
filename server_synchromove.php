<?php

//todo : get playername from session
$playerName = "";
$playerId = 1;


if(isset($_POST['gameId'])){
	$gameId = $_POST['gameId'];
	}
else{
	echo "no gameid";
	exit(100);
	}


$x1= $_POST['x1'];
$x2= $_POST['x2'];
$y1= $_POST['y1'];
$y2= $_POST['y2'];
$gameId = $_POST['gameId'];

//todo get user from cookie, check if user in game

$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$statement = $pdo->prepare(
	"SELECT
		player1, player2, turnNum, activePlayer 
	FROM
		games
	WHERE
		id = ?"
	);

$statement->bindParam(1, $gameId);
$statement->execute();
$row = $statement->fetch(PDO::FETCH_OBJ);
$turnNum = $row->turnNum;
$activePlayer = $row->activePlayer;


$statement = $pdo->prepare(
	"SELECT
		id, unitType, x, y, hp, moves, ammo
	FROM
		units	
	WHERE
		gameId = ? AND x = ? AND y = ?"
	);

$statement->execute(array($gameId,$x1,$y1));
$unit1 = $statement->fetch(PDO::FETCH_OBJ); 
$statement->execute(array($gameId,$x2,$y2));
$unit2 = $statement->fetch(PDO::FETCH_OBJ); 

$statement = $pdo->prepare(
	"UPDATE
		units	
	SET
		x = ?, y = ? 
	WHERE
		id = ?"
	);

$statement->execute(array($x2,$y2,$unit1->id));




//from now on - send current state

$statement = $pdo->prepare(
	"SELECT
		unitType, x, y, hp, moves, ammo
	FROM
		units
	WHERE
		gameId = ?"
	);

$unitList = "";
$statement->bindParam(1, $gameId);
$statement->execute();
while($row = $statement->fetch(PDO::FETCH_OBJ)){
	$lineStr = "$row->x;$row->y;$row->unitType;$row->hp;$row->moves;$row->ammo ";
	$unitList .= $lineStr;
	}
$unitList= substr($unitList, 0, -1);  // toss the last space of unitlist
//echo "event: boardState\n";
//echo "data: ";
echo "$gameId|$turnNum|$activePlayer|";
echo $unitList;


/*while (ob_get_level() > 0) {
    ob_end_flush();
    }*/
flush();


?>


