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
echo "Bonjour. Mám takovou impresi, že ty budeš $user.";
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

</body>
</html>
<?php
}
?>
