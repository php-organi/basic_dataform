<?php

// function totalFood($pdo){
//   $query = $pdo->prepare('SELECT COUNT(*) FROM `food`');
//   $query->execute();
//   $row = $query->fetch();
//   return $row[0];
// }
// function getfood($pdo, $id){
//   $query = $pdo->prepare('SELECT * FROM `food` where `id` = :id');
//   $query->bindValue(':id', $id);
//   $query->execute();
//   return $query->fetch();
// }

function query($pdo, $sql, $parameters = []){
  $query = $pdo->prepare($sql);
  foreach($parameters as $name => $value){
    $query->bindValue($name, $value);
  }
  $query->execute();

  return $query;
}

function totalFood($pdo){
  $query = query($pdo, 'SELECT COUNT(*) FROM `food`');
  $row = $query->fetch();
  return $row[0];
}

function getFood($pdo, $id ){
  $parameter = [':id' => $id];

  $query = query($pdo, 'SELECT * FROM `food` WHERE `id` = :id', $parameter);
  return $query->fetch();
}

function insertFood($pdo, $foodtext, $authorid){
  $query = 'INSERT INTO `food`(`foodtext`, `fooddate`, `authorid`)
            VALUES(:foodtext, CURDATE(), :authorid)';

  $parameters = [':foodtext' => $foodtext, ':authorid' => $authorid];

  query($pdo, $query, $parameters);
}
function updateFood($pdo, $foodid, $foodtext, $authorid){
  $query = 'UPDATE `food` SET `authorid` = :authorid, `foodtext` = :foodtext WHERE `id` = :id';

  $parameters = [':foodtext' => $foodtext, 'authorid'=>$authorid, ':id'=>$foodid];

  query($pdo, $query, $parameters);
}

function deleteFood($pdo, $id){
  $query = 'DELETE FROM `food` WHERE `id` = :id';
  $parameters = [':id'=> $id];

  query($pdo, $query, $parameters);
}

function allFood($pdo){
  $foods = query($pdo, 'SELECT `food`.`id`,`foodtext`,`name`,`email`  FROM `food` INNER JOIN `author` ON `authorid` = `author`.`id`');
  return $foods->fetchAll();
}