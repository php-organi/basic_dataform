<?php

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';

  $foods = allFood($pdo);

  $title = 'food 목록';

  $totalFood = totalFood($pdo);

  ob_start();

  include __DIR__ . '/../templates/foods.html.php';

  $output = ob_get_clean();

}
catch(PDOException $e){
  $title = '오류 발생';

  $output = ' db 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';