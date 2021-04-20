<?php
namespace Ijdb\Controllers;
use \Hanbit\DatabaseTable;

class Register{
  private $authorsTable;

  public function __counstruct(DatabaseTable $authorsTable){
    $this->authorsTable = $authorsTable;
  }

  public function registrationForm(){
    return ['template'=>'register.html.php', 'title'=>'사용자 등록'];
  }
  public function success(){
    return ['template'=>'registersuccess.html.php', 'title'=>'등록 성공'];
  }
  public function registerUser(){
    $author = $_POST['author'];

    $valid = true;
    $errors = [];

    if(empty($author['name'])){
      $valid = false;
      $errors[] = '이름 입력 바람';
    }

    if(empty($author['email'])){
      $valid = false;
      $errors[] = '이메일 입력 바람';
    }
    elseif(filter_var($author['email']) == false ){
      $valid = false;
      $errors[] = '유효하지 않은 이메일 주소';
    }
    else{
      $author['email'] = strtolower($author['email']);
      if(count($authorsTable->find('email', $author['email']))>0){
        $vaild = false;
        $errors[] = '이미 가입된 이메일 주소';
      }
    }

    if(empty($author['password'])){
      $valid = false;
      $errors[] = '비밀번호 입력 바람';
    }

    if($valid == true){
      $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

      $this->authorTable->save($author);
      header('location: /author/success');
    }
    else{
      return['template'=>'register.html.php',
            'title'=>'사용자 등록',
            'variables'=>['errors'=>$errors, 'author'=>$author]];
    }


  }
}