<?php

//todo : get playername from session
$playerName = "";
$playerId = 1;

$gameId = 0;

if(isset($_POST['gameId'])){
	$gameId = $_POST['gameId'];
	}
else{
	echo "no gameid";
	exit(100);
	}

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

$arr = array('status' => 0, 'gameId' => $gameId, 'turnNum' => $turnNum, 'activePlayer' => $activePlayer, 'unitList' => $unitList);

echo json_encode($arr);

/*while (ob_get_level() > 0) {
    ob_end_flush();
    }*/
flush();


?>


