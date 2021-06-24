<?php
  
  namespace App\Models\Entidades;

  class Usuario {
    private $id;
    private $nome;
    private $email;

    public function getId()
    {
      return $this->id;
    }

    public function getNome()
    {
      return $this->nome;
    }

    public function getEmail()
    {
      return $this->email;
    }

    public function setNome($nome)
    {
      $this->nome = $nome;
    }

    public function setEmail($email)
    {
      $this->email = $email;
    }
  }
?>