<?php

if(isset($_POST['foodtext'])){
  try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

    insertFood($pdo, $_POST['foodtext'], 1);


    header('location: foods.php');

  }
  catch(PDOException $e){
    $title = '오류가 발생했습니다';

    $output = '데이터베이스 오류: ' . $e->getMessage() . ', 위치: ' .
    $e->getFile() . ':' . $e->getLine();
  }
}
else{
  $title = 'food 글 등록';

  ob_start();

  include __DIR__ . '/../templates/addfoods.html.php';

  $output = ob_get_clean();

}

include __DIR__ . '/../templates/layout.html.php';