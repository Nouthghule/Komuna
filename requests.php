<?php
session_start();


if (!(isset($_SESSION['user']))) {
header("Refresh:0; url=komuna.php");
?>
<?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>

<?php
$user = $_SESSION['user'];
$nick = $_SESSION['nick'];
echo "Bonjour. Mám takovou impresi, že ty budeš $nick.";
?>

<table border="1" width="100%">
<tr>
<td style="text-align:center"><a href = "newgame.php">Nová hra</a></td>
<td style="text-align:center"><a href = "requests.php">Nabídky her</a></td>
<td style="text-align:center"><a href = "ongoing.php">Rozehrané hry</a></td>
<td style="text-align:center"><a href = "finished.php">Dohrané hry</a></td>
<td style="text-align:center"><a href = "logout.php">Odhlásit se</a></td>
</tr>
</table>
<br><br>

<?php

$myNick = $_SESSION['nick'];

$roott = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$stV = $pdo->prepare(
	"SELECT
		sender, recipient, player2, state
	FROM
		gameRequests
	WHERE
		player1 = ?"
	);

$stK = $pdo->prepare(
	"SELECT
		sender, recipient, player2, state
	FROM
		gameRequests
	WHERE
		player2 = ?"
	);

$stV->bindParam(1, $myNick);
$stK->bindParam(1, $myNick);

$stV->execute();
$stK->execute();

$endV = 0;
$endK = 0;

?>



<table border="1" width="100%">

<td style="text-align:center" width="20%" bgcolor = h></td>

<?php




?>

</table>

</body>
</html>
<?php
}
?>
