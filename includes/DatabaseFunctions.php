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

// function totalFood($pdo){
//   $query = query($pdo, 'SELECT COUNT(*) FROM `food`');
//   $row = $query->fetch();
//   return $row[0];
// }

// function getFood($pdo, $id ){
//   $parameter = [':id' => $id];

//   $query = query($pdo, 'SELECT * FROM `food` WHERE `id` = :id', $parameter);
//   return $query->fetch();
// }

// function insertFood($pdo, $foodtext, $authorid){
//   $query = 'INSERT INTO `food`(`foodtext`, `fooddate`, `authorid`)
//             VALUES(:foodtext, CURDATE(), :authorid)';
//   $parameters = [':foodtext' => $foodtext, ':authorid' => $authorid];
//   query($pdo, $query, $parameters);
// }
// function insertFood($pdo, $fields){
//   $query = 'INSERT INTO `food` (';
//   foreach($fields as $key=>$vaule){
//     $query .= '`'.$key.'`,';
//   }
//   $query = rtrim($query, ',');
//   $query .= ') VALUES (';

//   foreach($fields as $key=>$value){
//     $query .= ':'.$key.',';
//   }
//   $query = rtrim($query, ',');

//   $query .= ')';

//   $fields = processDates($fields);

//   // echo var_dump($fields);
//   query($pdo, $query, $fields);
// }


// function updateFood($pdo, $foodid, $foodtext, $authorid){
//   $query = 'UPDATE `food` SET `authorid` = :authorid, `foodtext` = :foodtext WHERE `id` = :id';
//   $parameters = [':foodtext' => $foodtext, 'authorid'=>$authorid, ':id'=>$foodid];
//   query($pdo, $query, $parameters);
// }

// function updateFood($pdo, $fields){
//    $query = 'UPDATE `food` SET ';
//    // foreach($fields as $key=>$vaule){
//    //   $query .= '`'.$key.'` = :'.$key.',';
//    // }

//    foreach ($fields as $key => $value) {
//  		$query .= '`' . $key . '` = :' . $key . ',';
//  	}

//    $query = rtrim($query, ',');
//    $query .= ' WHERE `id` = :primarykey';
//    $fields['primarykey'] = $fields['id'];

//    $fields = processDates($fields);
//   echo var_dump($fields);
//    query($pdo, $query, $fields);
//  }

// function deleteFood($pdo, $id){
//   $query = 'DELETE FROM `food` WHERE `id` = :id';
//   $parameters = [':id'=> $id];

//   query($pdo, $query, $parameters);
// }

// function allFood($pdo){
//   $foods = query($pdo, 'SELECT `food`.`id`,`foodtext`,`fooddate`,`name`,`email`  FROM `food` INNER JOIN `author` ON `authorid` = `author`.`id`');
//   return $foods->fetchAll();
// }

function processDates($fields){
  foreach($fields as $key=>$value){
    if($value instanceof DateTime){
      $fields[$key] = $value->format('Y-m-d H:i:s');
    }
  }
  return $fields;
}




function findAll($pdo, $table){
  $result = query($pdo, 'SELECT * FROM `' . $table . '`');
  return $result->fetchAll();
}

function delete($pdo, $table, $primarykey, $id){
  $parameters = [':id'=>$id];
  query($pdo, 'DELETE FROM `'.$table.'` WHERE `'.$primarykey.'` = :id', $parameters);
}

function insert($pdo, $table, $fields){
  $query = 'INSERT INTO `'.$table.'` (';

  foreach($fields as $key=>$value){
    $query .= '`'.$key.'`,';
  }

  $query = rtrim($query, ',');

  $query .= ') VALUES (';

  foreach($fields as $key=>$value){
    $query .= ':' . $key . ',';
  }

  $query = rtrim($query, ',');

  $query .= ')';

  $fields = processDates($fields);

  query($pdo, $query, $fields);
}

function update($pdo, $table, $primarykey, $fields){
  $query = ' UPDATE `'.$table.'` SET';

  foreach($fields as $key=>$value){
    $query .= '`'.$key.'` = :'.$key.',';
  }
  $query = rtrim($query, ',');

  $query .= ' WHERE `'.$primarykey.'` = :primarykey';

  $fields['primarykey'] = $fields['id'];

  $fields = processDates($fields);

  query($pdo, $query, $fields);

}

function findById($pdo, $table, $primarykey, $value){
  $query = 'SELECT * FROM `'.$table.'` WHERE `'.$primarykey.'` = :value';

  $parameters = ['value'=>$value];

  $query = query($pdo, $query, $parameters);

  return $query->fetch();
}

function total($pdo, $table){
  $query = query($pdo, 'SELECT COUNT(*) FROM `'.$table.'`');
  $row = $query->fetch();
  return $row[0];
}

function save($pdo, $table, $primarykey, $record){
  try{
    if($record[$primarykey] == ''){
      $record[$primarykey] = null;
    }
    insert($pdo, $table, $record);
  }
  catch(PDOException $e){
    update($pdo, $table, $primarykey, $record);
  }
}