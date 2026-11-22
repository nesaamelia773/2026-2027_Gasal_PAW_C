<?php
session_start();
header('Location: '.(!empty($_SESSION['user']) ? 'home.php' : 'login.php'));
exit;
