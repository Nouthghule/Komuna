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

<object type="text/html" data="headmenu.html"></object>


</body>
</html>
<?php
}
?>
