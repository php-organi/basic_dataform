<?php
namespace Hanbit;

class EntryPoint{
  private $route;
  private $routes;
  private $method;

  public function __construct(string $route, string $method, \Hanbit\Routes $routes){
    $this->route = $route;
    $this->routes = $routes;
    $this->method = $method;
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
    include __DIR__ . '/../../templates/' . $templateFileName;
    return ob_get_clean();
  }


  public function run(){
    $page = $this->routes->getRoutes();

      $controller = $routes[$this->route][$this->method]['controller'];
      $action = $routes[$this->route][$this->method]['action'];
      $page = $controller->$action();

    $title = $page['title'];

    if(isset($page['variables'])){
      $output = $this->loadTemplate($page['template'], $page['variables']);
    }
    else{
      $output = $this->loadTemplate($page['template']);
    }

    include __DIR__ . '/../../templates/layout.html.php';
  }

}