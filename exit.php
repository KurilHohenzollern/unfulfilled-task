<?php

require_once 'ListModel.php';

setcookie('user', $usersCol['user'], time() - 3600, "/");
header("Location: user_panel.php");

?>