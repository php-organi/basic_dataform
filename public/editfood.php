<?php

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try{
  if(isset($_POST['food'])){
    // updateFood($pdo, $_POST['foodid'], $_POST['foodtext'], 1);
    // updateFood($pdo, ['id'=>$_POST['foodid'],
    // 'foodtext'=>$_POST['foodtext'],'authorid'=>2]);

    // update($pdo, 'food', 'id', ['id'=>$_POST['foodid'], 'foodtext'=>$_POST['foodtext'], 'authorid'=>2]);

    // save($pdo, 'food','id', ['id'=> $_POST['foodid'], 'foodtext'=>$_POST['foodtext'], 'fooddate'=>new DateTime(), 'authorid'=>2]);
    $food = $_POST['food'];
    $food['fooddate'] = new DateTime();
    $food['authorid'] = 1;

    save($pdo,'food', 'id', $food);

    header('location: foods.php');
  }else{
    if(isset($_GET['id'])){
      $food = findById($pdo, 'food', 'id', $_GET['id']);

    }
    // $food = getFood($pdo, $_GET['id']);
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