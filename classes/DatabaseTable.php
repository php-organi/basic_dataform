<?php
class DatabaseTable{

  private $pdo;
  private $table;
  private $primarykey;

  public function __construct(PDO $pdo, string $table, string $primarykey){
    $this->pdo = $pdo;
    $this->table = $table;
    $this->primarykey = $primarykey;
  }

  private function query($sql, $parameters = []){
    $query = $this->pdo->prepare($sql);
    $query->execute($query);
    return $query;
  }

  public function total(){
    $query = $this->query('SELECT COUNT(*) FROM `'.$this->table.'`');
    $row = $query->fetch();
    return $row[0];
  }

  public function findById($value){
    $query = 'SELECT * FROM `'.$this->table.'` WHERE `'.$this->primarykey.'` = :value';

    $parameters = ['value'=>$value];

    $query = $this->query($query, $parameters);

    return $query->fetch();
  }

  public function insert($fields){
    $query = 'INSERT INTO `'.$this->table.'` (';

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

    $fields = $this->processDates($fields);

    $this->query($query, $fields);
  }

  public function update($fields){
    $query = ' UPDATE `'.$this->table.'` SET';

    foreach($fields as $key=>$value){
      $query .= '`'.$key.'` = :'.$key.',';
    }
    $query = rtrim($query, ',');

    $query .= ' WHERE `'.$this->primarykey.'` = :primarykey';

    $fields['primarykey'] = $fields['id'];

    $fields = $this->processDates($fields);

    $this->query($query, $fields);
  }

  public function delete($id){
    $parameters = [':id'=>$id];
    $this->query('DELETE FROM `'.$this->table.'` WHERE `'.$this->primarykey.'` = :id', $parameters);
  }

  public function findAll(){
    $result = $this->query('SELECT * FROM `' . $this->table . '`');
    return $result->fetchAll();
  }

  private function processDates($fields){
    foreach($fields as $key=>$value){
      if($value instanceof DateTime){
        $fields[$key] = $value->format('Y-m-d H:i:s');
      }
    }
    return $fields;
  }

  public function save($record){
    try{
      if($record[$this->primarykey] == ''){
        $record[$this->primarykey] = null;
      }
      $this->insert($record);
    }
    catch(PDOException $e){
      $this->update($record);
    }
  }
}