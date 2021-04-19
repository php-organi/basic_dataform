<?php
class FoodController{
  private $authorsTable;
  private $foodsTable;

  public function __construct(DatabaseTable $foodsTable, DatabaseTable $authorsTable){
    $this->foodsTable = $foodsTable;
    $this->authorsTable = $authorsTable;
  }

  public function list(){
    $result = $foodstable->findAll();
    $foods = [];
    foreach($result as $food){
      $author = $authorstable->findById($food['authorid']);

      $foods[] = [
        'id'=>$food['id'],
        'foodtext'=>$food['foodtext'],
        'fooddate'=>$food['fooddate'],
        'name'=>$author['name'],
        'email'=>$author['email'],
    ];
    }

    $title = 'food 목록';

    $totalFood = $foodstable->total();

    return ['template'=>'foods.html.php', 'title'=>$title,
            'variables'=>['totalfoods'=>$totalFood, 'foods'=>$foods]];
  }

  public function home(){
    $title = 'food 란?';
    return ['template'=>'home.html.php', 'title'=>$title];
  }

  public function delete(){
    $this->foodstable->delete($_POST['id']);
    header('location: /food/list');
  }

  public function edit(){
    if(isset($_POST['food'])){
      $food = $_POST['food'];
      $food['fooddate'] = new DateTime();
      $food['authorid'] = 1;

      $this->foodstable->save($food);

      header('location: /food/list');
    }else{
      if(isset($_GET['id'])){
        $food = $this->foodstable->findById($_GET['id']);

      }
      $title = 'food 글 수정';
    }

    return ['template'=>'editfood.html.php', 'title'=>$title,
            'variables'=>['food'=>$food ?? null]];
  }
}