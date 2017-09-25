<?php

$sleepCycle = 1000000; //time to sleep per one cycle in microsec.
$maxCycle = 120;


if(isset($_POST['gameId'])){
	$gameId = $_POST['gameId'];
	}
else{
	echo "no gameid";
	exit(100);
	}



//todo get user from cookie, check if user in game

$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$currCycle = 0;
$timeout = 1;

while($currCycle<$maxCycle){

	$statement = $pdo->prepare(
		"SELECT
			sentMove, lastMove
		FROM
			games
		WHERE
			id = ?"
		);

	$statement->bindParam(1, $gameId);
	$statement->execute();
	$game = $statement->fetch(PDO::FETCH_OBJ);

	if($game->sentMove!=$game->lastMove){
		break;
		}

	$currCycle = $currCycle + 1;
	usleep($sleepCycle);
	}

if($timeout){
	//todo send timeout msg
	exit(100);
	}
	
$statement = $pdo->prepare(
	"UPDATE
		games
	SET
		sentMove = lastMove
	WHERE
		id = ?"
	);

$statement->bindParam(1, $gameId);
$statement->execute();


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


