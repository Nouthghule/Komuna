<?php
//header("Content-Type: text/event-stream\n\n");
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$gameId = 0;

if(isset($_POST['gameId'])){
	$gameId = $_POST['gameId'];
	}
else{
	exit(100);
	}

$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$statement = $pdo->prepare(
	"SELECT
		unitType, x, y, hp, moves, ammo
	FROM
		units
	WHERE
		gameId = :gameId"
	);

$unitList = "";
$result = $statement->execute(array('gameId' => $gameId, ));
while($row = $statement->fetch(PDO::FETCH_OBJ)){
	$lineStr = "$row->x;$row->y;$row->unitType;$row->hp;$row->moves;$row->ammo ";
	$unitList .= $lineStr;
	}
//echo "event: boardState\n";
echo "data: ";
echo "$gameId|";
echo $unitList;


/*while (ob_get_level() > 0) {
    ob_end_flush();
    }*/
flush();


?>


