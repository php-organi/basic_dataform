<?php
// function loadTemplate($templateFileName,$variables = []){
//   extract($variables);

//   ob_start();
//   include __DIR__ . '/../templates/' . $templateFileName;
//   return ob_get_clean();
// }

try{
  include __DIR__ . '/../classes/EntryPoint.php';
  // include __DIR__ . '/../includes/DatabaseConnection.php';
  // include __DIR__ . '/../classes/DatabaseTable.php';
  // include __DIR__ . '/../classes/controllers/FoodController.php';

  // $foodsTable = new DatabaseTable($pdo, 'food', 'id');
  // $authorsTable = new DatabaseTable($pdo, 'author', 'id');

  // $foodController = new FoodController($foodsTable, $authorsTable);

  // $action = $_GET['action'] ?? 'home';

// roote 변수가 없으면 'food/home' 할당
// $roote = $_GET['roote'] ?? 'food/home';
$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
$entryPoint = new EntryPoint($route);
$entryPoint.run();

// if($route == strtolower($route)){
//   if($route === 'food/list'){
//     include __DIR__ . '/../classes/controllers/FoodController.php';
//     $controller = new FoodController($foodsTable, $authorsTable);
//     $page = $controller->list();
//   }elseif($route === 'food/home'){
//     include __DIR__ . '/../classes/controllers/FoodController.php';
//     $controller = new FoodController($foodsTable, $authorsTable);
//     $page = $controller->home();
//   }elseif($route === 'food/edit'){
//     include __DIR__ . '/../classes/controllers/FoodController.php';
//     $controller = new FoodController($foodsTable, $authorsTable);
//     $page = $controller->edit();
//   }elseif($route === 'food/delete'){
//     include __DIR__ . '/../classes/controllers/FoodController.php';
//     $controller = new FoodController($foodsTable, $authorsTable);
//     $page = $controller->delete();
//   }elseif($route === 'food/list'){
//     include __DIR__ . '/../classes/controllers/FoodController.php';
//     $controller = new FoodController($foodsTable, $authorsTable);
//     $page = $controller->list();
//   }if($route === 'register'){
//     include __DIR__ . '/../classes/controllers/RegisterController.php';
//     $controller = new RegisterController($authorsTable);
//     $page = $controller->showForm();
//   }
// }else{
//   http_response_code(301);
//   header('location: index.php?route=' . strtolower($route));
// }


  // if($action == strtolower($action)){
  //   $page = $foodController->$action();
  // }else{
  //   http_response_code(301);
  //   header('location: index.php?action=' . strtolower($action));
  // }

  // $page = $foodController->$action();

  // $title = $page['title'];

  // if(isset($page['variables'])){
  //   $output = loadTemplate($page['template'],$page['variables']);
  // }else{
  //   $output = loadTemplate($page['template']);
  // }

}catch(PDOException $e){
  $title = '오류 발생';

  $output = ' db 오류: ' . $e->getMessage() . ', 위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';