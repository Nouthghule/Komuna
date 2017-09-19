
<?php
// Work out the path to the database, so SQLite/PDO can connect
$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;
// Connect to the database, run a query, handle errors
$pdo = new PDO($dsn);
$stmt = $pdo->prepare(
    'SELECT
    	id, unitType, x, y, hp
    FROM
        units
    WHERE
        gameId = 1'
);

$result = $stmt->execute();
// Let's get a row
while($row = $stmt->fetch(PDO::FETCH_OBJ)){
	echo "Jednotka : id = $row->id , type = $row->unitType, at [$row->x,$row->y], with hp = ($row->hp)
	";
	}


?>
