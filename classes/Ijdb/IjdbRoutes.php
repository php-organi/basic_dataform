<?php
namespace Ijdb;

class IjdbRoutes implements \Hanbit\Routes {
  private $authorController;
  private $foodsTable;
  private $authentication;

  public function __construct(){
    include __DIR__ . '/../../includes/DatabaseConnection.php';

    $this->foodsTable = new \Hanbit\DatabaseTable($pdo, 'food', 'id');
    $this->authorsTable = new \Hanbit\DatabaseTable($pdo, 'author', 'id');
    $this->authentication = new \Hanbit\Authentication($this->authorsTable, 'email', 'password');
  }

  public function getRoutes(): array {

    $foodController = new \Ijdb\Controller\Food($this->foodsTable, $this->authorsTable, $this->authentication);
    $authorController = new \Ijdb\Controller\Register($this->authorsTable);

      $routes = [
        'food/edit'=>[
          'POST'=>[
            'controller'=>$foodController, 'action'=>'saveEdit'
          ],
          'GET'=>[
            'controller'=>$foodController, 'action'=>'edit'
          ],
          'login' => true
        ],
        'food/delete'=>[
          'POST'=>[
            'controller'=>$foodController, 'action'=>'delete'
          ],
          'login' => true
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
        ],
        'author/register'=>[
          'GET'=>[
            'controller'=>$authorController, 'action'=>'registrationForm'
          ],
          'POST'=>[
            'controller'=>$authorController, 'action'=>'registerUser'
          ]
        ],
        'author/success'=>[
          'GET'=>[
            'controller'=>$authorController, 'action'=>'success'
          ]
        ],
        'login/error'=>[
          'GET'=>[
            'controller'=>'$loginController',
            'action'=>'error'
          ]
        ],
        'login'=>[
          'GET'=>[
            'controller'=>$loginController, 'action'=>'loginform'
          ],
          'POST'=>[
            'controller'=>$loginController, 'action'=>'processLogin'
          ]
        ],
        'login/success'=>[
          'GET'=>[
            'controller'=>$loginController, 'action'=>'success'
          ],
          'login'=>true
        ],
        'logout'=>[
          'GET'=>[
            'controller'=>$loginController, 'action'=>'logout'
          ]
        ]
      ];
      return $routes;
  }
  public function getAuthentication(): \Hanbit\Authentication{
    return $this->authentication;
  }
}