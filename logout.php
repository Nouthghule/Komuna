<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['nick']);

echo "Ok. Odhlaseni uspesne.";
exit(0);
?>
