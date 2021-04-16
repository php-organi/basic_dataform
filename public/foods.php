<?php

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';

  $result = findAll($pdo, 'food');
  // var_dump($result);
  $foods = [];
  foreach($result as $food){
    $author = findById($pdo, 'author', 'id', $food['authorid']);

    $foods[] = [
      'id'=>$food['id'],
      'foodtext'=>$food['foodtext'],
      'fooddate'=>$food['fooddate'],
      'name'=>$author['name'],
      'email'=>$author['email'],
    ];
  }

  $title = 'food 목록';

  $totalFood = total($pdo, 'food');

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