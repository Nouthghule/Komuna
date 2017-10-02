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

<object type="text/html" data="headmenu.html" width="100%"></object>

<br><br>

Do kolonky druhý hráč zadej hráčovu přezdívku (to, co se mu/jí zobrazuje na vrcholu stránky v pozdravu.)<br>
Druhý hráč obdrží 

<form action="requestGame.php" method="post">
Druhý hráč : <input type="text" name ="targetNick">
<select name="senderSide">
Chci být : <br>
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
