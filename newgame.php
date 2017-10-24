<?php
ob_start();
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

<div w3-include-html="headmenu.html"></div> 
<script src="w3.js"></script> 
<script>w3.includeHTML();</script>


<br><br>

Do kolonky druhý hráč zadej hráčovu přezdívku (to, co se mu/jí zobrazuje na vrcholu stránky v pozdravu.)<br>
Druhý hráč obdrží nabídku hry do své sekce nabídky her. Až ji přijme, založí se vám nová hra v sekci rozehrané hry.
<br><br><br>

<form action="requestGame.php" method="post">
Druhý hráč : <input type="text" name ="targetNick">
<br>Chci být :
<select name="senderSide">
<option value=1>Vojsko</option>
<option value=2>Komuna</option>
</select>
<input type="submit" name="submit" value="Poslat nabídku hry" />
</form>


</body>
</html>
<?php
}
?>
