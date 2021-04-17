<?php

// $title = 'food 란?';
// ob_start();
// include __DIR__ . '/../templates/home.html.php';
// $output = ob_get_clean();

//템플릿을 불러오는 코드를 별도 함수로 분리--------------------------------------
function loadTemplate($templateFileName,$variables = []){
  extract($variables);

  ob_start();
  include __DIR__ . '/../templates/' . $templateFileName;
  return ob_get_clean();
}

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../classes/controllers/FoodController.php';

  $foodsTable = new DatabaseTable($pdo, 'food', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  $foodController = new FoodController($foodsTable, $authorsTable);

  // if(isset($_GET['edit'])){
  //   $page = $foodController->edit();
  // }
  // else if(isset($_GET['delete'])){
  //   $page = $foodController->delete();
  // }
  // else if(isset($_GET['list'])){
  //   $page = $foodController->list();
  // }
  // else{
  //   $page = $foodController->home();
  // }

  $action = $_GET['action'] ?? 'home';

  $page = $foodController->$action();

  $title = $page['title'];
  // $output = $page['output'];
  // $variables = $page['variables'];

  if(isset($page['variables'])){
    $output = loadTemplate($page['template'],$page['variables']);
  }else{
    $output = loadTemplate($page['template']);
  }

  ob_start();

  include __DIR__ . '/../templates/' .$page['templates'];

  $output = ob_get_clean();

}catch(PDOException $e){
  $title = '오류 발생';

  $output = ' db 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';