<?php

class EntryPoint{
  private $route;

  public function __construct($route){
    $this->route = $route;
    $this->checkUrl();
  }

  private function checkUrl(){
    if($this->route !== strtolower($this->route)){
      http_response_code(301);
      header('location: ' . strtolower($this->route));
    }
  }

  private function loadTemplate($templateFileName,$variables = []){
    extract($variables);
    ob_start();
    include __DIR__ . '/../templates/' . $templateFileName;
    return ob_get_clean();
  }

  private function callAction(){
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $foodsTable = new DatabaseTable($pdo, 'food', 'id');
    $authorsTable = new DatabaseTable($pdo, 'author', 'id');

    if($route === 'food/list'){
      include __DIR__ . '/../classes/controllers/FoodController.php';
      $controller = new FoodController($foodsTable, $authorsTable);
      $page = $controller->list();
    }elseif($route === 'food/home'){
      include __DIR__ . '/../classes/controllers/FoodController.php';
      $controller = new FoodController($foodsTable, $authorsTable);
      $page = $controller->home();
    }elseif($route === 'food/edit'){
      include __DIR__ . '/../classes/controllers/FoodController.php';
      $controller = new FoodController($foodsTable, $authorsTable);
      $page = $controller->edit();
    }elseif($route === 'food/delete'){
      include __DIR__ . '/../classes/controllers/FoodController.php';
      $controller = new FoodController($foodsTable, $authorsTable);
      $page = $controller->delete();
    }elseif($route === 'food/list'){
      include __DIR__ . '/../classes/controllers/FoodController.php';
      $controller = new FoodController($foodsTable, $authorsTable);
      $page = $controller->list();
    }if($route === 'register'){
      include __DIR__ . '/../classes/controllers/RegisterController.php';
      $controller = new RegisterController($authorsTable);
      $page = $controller->showForm();
    }
    return $page;
  }

  public function run(){
    $page = $this->callAction();

    $title = $page['title'];

    if(isset($page['variables'])){
      $output = $this->loadTemplate($page['template'], $page['variables']);
    }
    else{
      $output = $this->loadTemplate($page['template']);
    }

    include __DIR__ . '/../templates/layout.html.php';
  }

}