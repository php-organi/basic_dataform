<?php

function query($pdo, $sql, $parameters = []){
  $query = $pdo->prepare($sql);
  foreach($parameters as $name => $value){
    $query->bindValue($name, $value);
  }
  $query->execute();

  return $query;
}

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