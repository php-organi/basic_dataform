<?php
namespace Ijdb;

class IjdbRoutes implements \Hanbit\Routes {
  // public function callAction($route){
  public function getRoutes(){
    include __DIR__ . '/../../includes/DatabaseConnection.php';

    $foodsTable = new \Hanbit\DatabaseTable($pdo, 'food', 'id');
    $authorsTable = new \Hanbit\DatabaseTable($pdo, 'author', 'id');

    $foodController = new \Ijdb\Controller\Food($foodsTable, $authorsTable);

    // if($route === 'food/list'){
    //   $controller = new \Ijdb\Controllers\Food($foodsTable, $authorsTable);
    //   $page = $controller->list();
    // }elseif($route === ''){
    //   $controller = new \Ijdb\Controllers\Food($foodsTable, $authorsTable);
    //   $page = $controller->home();
    // }elseif($route === 'food/edit'){
    //   $controller = new \Ijdb\Controllers\Food($foodsTable, $authorsTable);
    //   $page = $controller->edit();
    // }elseif($route === 'food/delete'){
    //   $controller = new \Ijdb\Controllers\Food($foodsTable, $authorsTable);
    //   $page = $controller->delete();
    // }elseif($route === 'register'){
    //   $controller = new \Ijdb\Controllers\Register($authorsTable);
    //   $page = $controller->showForm();
    // }
    // return $page;

      $routes = [
        'food/edit'=>[
          'POST'=>[
            'controller'=>$foodController, 'action'=>'saveEdit'
          ],
          'GET'=>[
            'controller'=>$foodController, 'action'=>'edit'
          ]
        ],
        'food/delete'=>[
          'POST'=>[
            'controller'=>$foodController, 'action'=>'delete'
          ]
        ],
        'food/list'=>[
          'GET'=>[
            'controller'=>$foodController, 'action'=>'list'
          ]
        ],
        ''=>[
          'GET'=>[
            'controller'=>$foodController, 'action'=>'home'
          ]
        ]
      ];
      // $method = $_SERVER['REQUEST_METHOD'];
      // $controller = $routes[$route][$method]['controller'];
      // $action = $routes[$route][$method]['action'];

      // return $controller->$action();
      return $routes;
  }
}