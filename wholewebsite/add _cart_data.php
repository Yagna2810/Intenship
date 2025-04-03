<?php
session_start();

$jsonData = file_get_contents('php://input');

$cartData = json_decode($jsonData, true);

$_SESSION['cart'] = $cartData;
?>