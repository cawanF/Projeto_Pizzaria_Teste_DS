<?php
  namespace App\Lib;

  use PDO; //PHP Data Objects
  use PDOException;
  use Exception;
  //Classe seguindo padrão slingleton, isso pq ele precine um possivel stack overflow
  
  class Conexao {
    //Atributo para armazenar a conexão da instancia do PDO
    private static $connection;
    //Método cinstrutor privado para evitar que seka instanciada a classe
    
    private function __construct() {}
    //Método para retornar a instancia da conexão com o banco de dados, utilizando o PDO
    
    public static function getConnection() {
      $pdoConfig = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";";
    
      try {
        if(!isset($connection)) {
          $connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD); //Atributo connection recebe a instancia da conexao
          
          //O erro padro do PFO é o PDO::ERRMODE_SILENT, mas no nosso cod usamos o PDO:ERRMODE_EXCEPTION para que seja lançada uma exceção em caso de erro do pdo
          $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $connection;
      } catch (PDOException $e) {
        throw new Exception("Erro de conexão com o banco de dados", 500);
      }
    }
  }
?>