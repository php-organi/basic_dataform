<?php

if(isset($_POST['foodtext'])){
  try{
    $pdo = new PDO('mysql:host=localhost;dbname=board;charset=utf8','php-or','php-or');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO `food` SET
            `foodtext` = :foodtext,
            `fooddate` = CURDATE()';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':foodtext', $_POST['foodtext']);
    $stmt->execute();

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