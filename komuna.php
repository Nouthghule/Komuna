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
<br>
<object type="text/html" data="headmenu.html" width="100%"></object>

</body>
</tabe>
</html>
<?php
}
?>
