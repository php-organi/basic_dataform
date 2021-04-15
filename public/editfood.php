<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try{
  if(isset($_POST['foodtext'])){
    updateFood($pdo, $_POST['foodid'], $_POST['foodtext'], 1);

    header('location: foods.php');
  }else{
    $food = getFood($pdo, $_GET['id']);
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