<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config.php';

function wajibLogin() {
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}
function wajibOwner() {
    wajibLogin();
    if ((int)$_SESSION['user']['level'] !== 1) {
        header('Location: home.php');
        exit;
    }
}
function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
