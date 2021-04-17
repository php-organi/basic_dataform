<?php

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';

  //delete($pdo, 'food', 'id', $_POST['id']);
  $foodstable = new DatabaseTable($pdo, 'food', 'id');
  $foodstable->delete($_POST['id']);

  header('location: foods.php');
}
catch(PDOException $e){
  $title = '오류 발생';

  $output = ' db 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';