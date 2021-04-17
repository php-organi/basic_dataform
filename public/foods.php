<?php

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';

  $foodstable = new DatabaseTable($pdo, 'food', 'id');
  $authorstable = new DatabaseTable($pdo, 'author', 'id');

  $result = $foodstable->findAll();
  $foods = [];
  foreach($result as $food){
    // $author = findById($pdo, 'author', 'id', $food['authorid']);
    $author = $authorstable->findById($food['authorid']);

    $foods[] = [
      'id'=>$food['id'],
      'foodtext'=>$food['foodtext'],
      'fooddate'=>$food['fooddate'],
      'name'=>$author['name'],
      'email'=>$author['email'],
    ];
  }

  $title = 'food 목록';

  $totalFood = $foodstable->total();

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