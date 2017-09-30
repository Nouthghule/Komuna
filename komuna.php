<?php
session_start();


if (!(isset($_SESSION['user']))) {
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
Zde se prosím přihlaš. Nemáš-li zatím účet, <a href="register.html">zaregistruj se</a>. <br>
<form action="/login.php" method="post">
Login : <input type="text" name="login"><br>
Heslo : <input type="password" name="password"><br>
<input type="submit" value="Přihlásit se">
</body>
</html>
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

</body>
</html>
<?php
}
?>
