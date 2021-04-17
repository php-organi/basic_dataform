<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$foodstable = new DatabaseTable($pdo, 'food', 'id');

try{
  if(isset($_POST['food'])){
    $food = $_POST['food'];
    $food['fooddate'] = new DateTime();
    $food['authorid'] = 1;

    //save($pdo,'food', 'id', $food);
    $foodstable->save($food);

    header('location: foods.php');
  }else{
    if(isset($_GET['id'])){
      // $food = findById($pdo, 'food', 'id', $_GET['id']);
      $food = $foodstable->findById($_GET['id']);

    }
    $title = 'food 글 수정';

    ob_start();
    include __DIR__ . '/../templates/editfood.html.php';
    $output = ob_get_clean();

  }

}
catch(PDOException $e){
  $title = '오류가 발생했습니다';

  $output = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';