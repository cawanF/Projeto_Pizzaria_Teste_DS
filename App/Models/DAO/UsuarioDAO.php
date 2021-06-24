<?php

  namespace App\Models\DAO;

  use App\Models\Entidades\Usuario;

  class UsuarioDAO extends BaseDAO {

    public function verificaEmail($email) {
      try {
        $query = $this->select("select * from tb_user where cd_email = '$email'");
        return $query->fetch();

      } catch (Exception $e) {
        throw new \Exception("Erro no acesso aos dados.", 500);
      }
    }

    public function salvar(Usuario $usuario) {
      try {
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        return $this->insert('tb_user', ":nm_user,:cd_email", [':nm_user'=>$nome, 'cd_email'=>$email]);
      } catch (\Exception $e) {
        throw new \Exception("Erro na gravação de dados", 500);
      }
    }
  }
?>