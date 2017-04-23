<?php

  /**
   * Clase conexion para Oracle
   * Jose Flores Garcia github: @jafg1222
   */
  class oracleConexion
  {

    private $host;
    private $user;
    private $password;
    public $e;

    private $conex;
    public $sqlQuery;
    private $sentencia;
    public $error;

    function __construct($user = "", $password = "", $host = "", $e = "",$sqlQuery = "",$error = "")
    {
            $this->host = $host;
            $this->user = $user;
            $this->psswd = $password;
            $this->e = $e;
            $this->error = $error;
            $this->sqlQuery = $sqlQuery;
    }

    /**
        * @param $user <b>Connection User</b>
        */
       public function setUser($user){
           $this->user = $user;
       }

       /**
        * @return string <b>Connection User</b>
        */
       public function getUser(){
           return $this->user;
       }

       /**
        * @param $psswd <b>Connection Password</b>
        */
       public function setPsswd($password){
           $this->psswd = $password;
       }

       /**
        * @param $dbInstance <b>Connection Database Instance</b>
        */
       public function setHost($host){
           $this->host = $host;
       }

       /**
        * @return string <b>Connection Database Instance</b>
        */
       public function getHost(){
           return $this->host;
       }


       /**
        * @param $dbInstance <b>Connection Database </b>
        */
       public function setDb($databse){
           $this->db = $databse;
       }

       /**
        * @return string <b>Connection Database </b>
        */
       public function getDb(){
           return $this->db;
       }

       public function setSqlQuery($sqlQuery){
           $this->sqlQuery = $sqlQuery;
       }


        public function getSqlQuery($sqlQuery){
           return $this->sqlQuery;
       }

       public function seterror($error){
           $this->error = $error;
       }


        public function geterror($error){
           return $this->error;
       }

       public function conectar(){        
        $this->conex = oci_connect($this->user, $this->psswd, $this->host);       
        return $this->conex;                  
      }

      public function execCrud($conex,$sqlStmn){
        $stid = oci_parse($conex,$sqlStmn);
        $resultado =  oci_execute($stid);
        if(true === $resultado){          
            return true;
        } else {            
            $e = oci_error($stid);
            return "Error: " . $e['message'];
        }        
      }

      public function execSelect($conex,$sqlStmn){
          if (!$conex) {
              $e = oci_error();
              return "Error: " . $e['message'];
        }
              $stid = oci_parse($conex,$sqlStmn);
              oci_execute($stid);              
              return $stid;                            
              
              
      }        
        
       


  }


?>
