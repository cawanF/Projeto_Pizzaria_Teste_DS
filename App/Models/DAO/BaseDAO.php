<?php //vai no arquivo do errr 401, na pasta de view!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  namespace App\Models\DAO;

  use App\Lib\Conexao;

  abstract class BaseDAO {
    private $conexao;

    public function __construct(){
      $this->conexao = Conexao::getConnection();
    }

    public function select($sql) {
      if(!empty($sql)) {
        return $this->conexao->query($sql);
      }
    }

    public function insert($table, $cols, $values) {
      if(!empty($table) && !empty($cols) && !empty($values)) {
        $parametros = $cols;
        $colunas = str_replace(":", "", $cols);

        /*
          INSERT INTO usuario (nome,email) VALUES (:nome,:email);
        */

        $stmt = $this->conexao->prepare("insert into $table ($colunas) values ($parametros)");
        $stmt->execute($values);

        return $stmt->rowCount();
      } else {
        return false;
      }
    }
  }
?>