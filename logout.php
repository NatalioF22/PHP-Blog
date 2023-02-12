<?php

session_start();

session_destroy();
$session_in = false;

header("Location: login.php");
exit;