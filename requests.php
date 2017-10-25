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
		player1 = ? and state = 0 and recipient = player1"
	);

$stK = $pdo->prepare(
	"SELECT
		id, sender, recipient, player2, state
	FROM
		gameRequests
	WHERE
		player2 = ? and state = 0 and recipient = player2"
	);

$stI = $pdo->prepare(
	"SELECT
		id, sender, recipient, player2, player1, state
	FROM
		gameRequests
	WHERE
		(player2 = ? or player1 = ?) and state = 1"
	);

$stV->bindParam(1, $myNick);
$stK->bindParam(1, $myNick);
$stI->bindParam(1, $myNick);
$stI->bindParam(2, $myNick);

$stV->execute();
$stK->execute();
$stI->execute();

$endV = 0;
$endK = 0;

?>



<table border="1" width="100%">

<tr><td><b>Hry cekajici na inicializaci</b></td></tr>
<?php
while($ret = $stI->fetch(PDO::FETCH_OBJ)){
	$id 	= $ret->id;
	$player1= $ret->player1;
	$player2= $ret->player2;
	$isKom  = 0;
	$foe = $player2;
	$str = "vojsko";
	if($myNick===$player2){
		$isKom = 1;
		$foe = $player1;
		$str = "komunardy";
		}
	

	echo "<tr><td>Proti $foe, budes hrat za $str";
	echo "</td><td>";
	echo "<form action=\"initGame.php\" method=\"post\">";
	if($isKom){
		echo "<button name=\"id\" value=\"$id\">Inicializovat hru</button>";
	}
	else{
		echo "Tuto hru musi inicializovat tvuj protivnik.";
		}
	echo "</form>";
	}
?>

</table>
<br><br>


<table border="1" width="100%">

<tr><td><b>Nabidky her za vojsko<b></td></tr>

<?php
while($ret = $stV->fetch(PDO::FETCH_OBJ)){
	$origin =  $ret->sender;
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

<tr><td><b>Nabidky her za komunardy</b></td></tr>

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
	echo "\n";
	}
?>








</table>

</body>
</html>
<?php
}
?>
