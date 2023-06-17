<?php

class Database{
    private $connection;
      //create constructor
      function __construct(){
        //create MYSQL object 
        try{
          $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
       
        }catch(Exception $e){
          echo $e->getMessage();
        }
         
      }
      private function getBindParmsDataType($data){
        //Assume $data is Array
        $dt='';
        foreach($data as $value){
        if(is_float($value)) $dt.='d';
        elseif(is_integer($value)) $dt.='i';
        elseif(is_string($value)) $dt.='s';
        else $dt.='b';
        } 
        return $dt;
      }
      private function getLabels($values){
        $label="";
        foreach($values as $value){
            $label .='?,';
        }
        $label = substr_replace($label ,'',-1);
        return $label;
      }
      //for update method
      private function getLabelsWithName($columns){
        $label="";
        $columns = explode(',',$columns);

        foreach($columns as $column){
            $label .=$column.'=?,';
        }
        $label = substr_replace($label ,'',-1);
        return $label;
      }
      public function clean($data){
        return $this->connection->real_escape_string($data);
       }
      //dynamic function to insert data 
      public function insert($table, $columns, $values){
        $label = $this->getLabels($values);
        $query = "INSERT INTO $table($columns) VALUES($label)";
        $obj= $this->connection->prepare($query);
        $obj-> bind_param($this->getBindParmsDataType($values),...$values);
        return $obj->execute();
      }
      
      public function read($table, $columns="*", $conditions=''){
        $query = "SELECT $columns FROM $table $conditions";
       // die($query);
         $result = $this->connection->query($query);
         return $result->fetch_all(true);

      }
       
      public function delete($table,$condition){
        $query = "DELETE FROM $table WHERE $condition";
        return $this->connection->query($query);
      }
      public function update($table, $columns, $values, $condition){
        $label = $this->getLabelsWithName($columns);
        $query = "UPDATE $table SET $label WHERE $condition";
        //die($query);
        $obj=$this->connection->prepare($query);
        $obj-> bind_param($this->getBindParmsDataType($values),...$values);
        return $obj->execute();
      }

}