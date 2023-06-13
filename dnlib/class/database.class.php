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

      public function insert($table, $columns, $values){
            die($this->getBindParmsDataType($values));
        $query = "INSERT INTO $table($columns) VALUES(?,?)";
        $obj=$this->connection->prepare($query);
        $obj-> bind_param('si',...$values);
        $obj->execute();
      }

}