<?php

try{
  $pdo = new PDO('mysql:host=localhost;dbname=board;charset=utf8','php-or','php-or');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT `food`.`id`,`foodtext`,`name`,`email`  FROM `food` INNER JOIN `author` ON `authorid` = `author`.`id`';

  // $result = $pdo->query($sql);

  // while($row = $result->fetch()){
  //    $foods[] = $row['foodtext'];
  // }

  $foods = $pdo->query($sql);

  //var_dump($foods);

  $title = 'food 목록';

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