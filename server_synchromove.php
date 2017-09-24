<?php

//todo : get playername from session
$playerName = "";
$playerId = 1;
$validMove = 1; //todo implement checking for validity of move
$moveType = 1; //todo get from post 
$side = 1; //todo find out from playername and game->player1 and player2


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
$game = $statement->fetch(PDO::FETCH_OBJ);


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

//generate move and add it to database

if($validMove){
	
	$statement = $pdo->prepare(
		"INSERT INTO
			moves
			(gameId,moveNum,x1,x2,y1,y2,moveType,side,arg1,arg2,arg3,arg4)
		VALUES
			(?,?,?,?,?,?,?,?,?,?,?,?)
		");

	$a1 = $unit1->hp;
	$a2 = null;
	$a3 = null;
	$a4 = null;

	$statement->execute(array($gameId,$game->lastMove+1,$x1,$x2,$y1,$y2,$moveType,$side,$a1,$a2,$a3,$a4));

	
	$statement = $pdo->prepare(
		"UPDATE
			games
		SET
			lastMove = lastMove + 1
		WHERE
			id = ?"
		);
	$statement->execute(array($gameId));


	}


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


