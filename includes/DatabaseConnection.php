<?php

$pdo = new PDO('mysql:host=localhost;dbname=board;charset=utf8','php-or','php-or');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);