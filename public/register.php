<?php
function loadTemplate($templateFileName,$variables = []){
  extract($variables);

  ob_start();
  include __DIR__ . '/../templates/' . $templateFileName;
  return ob_get_clean();
}

try{
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';
  include __DIR__ . '/../classes/controllers/RegisterController.php';

  $foodsTable = new DatabaseTable($pdo, 'food', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  $registerController = new RegisterController($authorsTable);

  $action = $_GET['action'] ?? 'home';

  if($action == strtolower($action)){
    $page = $registerController->$action();
  }else{
    http_response_code(301);
    header('location: index.php?action=' . strtolower($action));
  }

  $title = $page['title'];

  if(isset($page['variables'])){
    $output = loadTemplate($page['template'],$page['variables']);
  }else{
    $output = loadTemplate($page['template']);
  }

}catch(PDOException $e){
  $title = '오류 발생';

  $output = ' db 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';