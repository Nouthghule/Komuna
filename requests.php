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

<br>
<div w3-include-html="headmenu.html"></div> 
<script src="w3.js"></script> 
<script>w3.includeHTML();</script>



<br><br>

<?php

$myNick = $_SESSION['nick'];

$root = __DIR__;
$database = $root . '/data/data.sqlite';
$dsn = 'sqlite:' . $database;

$pdo = new PDO($dsn);


$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$stV = $pdo->prepare(
	"SELECT
		id, sender, recipient, player1, state
	FROM
		gameRequests
	WHERE
		player1 = ?"
	);

$stK = $pdo->prepare(
	"SELECT
		id, sender, recipient, player2, state
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

<tr><td>Nabidky her za vojsko</td></tr>

<?php
while($ret = $stV->fetch(PDO::FETCH_OBJ)){
	$origin =  $ret->sender;
	$state  =  $ret->state;
	$id 	= $ret->id;
	echo "<tr><td> Od $origin </td><td>";
	echo "<form action=\"replyToRequest.php\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
	echo "<button name=\"rep\" value=\"1\">Prijmout</button>";
	echo "<button name=\"rep\" value=\"0\">Odmitnout</button>";
	echo "</form>";
	echo "</td></tr>";
	}
?>

<tr><td>Nabidky her za komunardy</td></tr>

<?php
while($ret = $stK->fetch(PDO::FETCH_OBJ)){
	$origin =  $ret->sender;
	$state  =  $ret->state;
	$id 	= $ret->id;
	echo "<tr><td> Od $origin </td><td>";
	echo "<form action=\"replyToRequest.php\" method=\"post\">";
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\"/>";
	echo "<button name=\"rep\" value=\"1\">Prijmout</button>";
	echo "<button name=\"rep\" value=\"0\">Odmitnout</button>";
	echo "</form>";
	echo "</td></tr>";
	}
?>








</table>

</body>
</html>
<?php
}
?>
