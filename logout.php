<?php
ob_start();
session_start();
unset($_SESSION['user']);
unset($_SESSION['nick']);

echo "Ok. Odhlaseni uspesne.";
header( "refresh:4;url=komuna.php" );
exit(0);
?>
