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

Do kolonky druhý hráč zadej hráčovu přezdívku (to, co se mu/jí zobrazuje na vrcholu stránky v pozdravu.)<br>
Druhý hráč obdrží nabídku hry do své sekce nabídky her. Až ji přijme, založí se vám nová hra v sekci rozehrané hry.
<br><br><br>

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
