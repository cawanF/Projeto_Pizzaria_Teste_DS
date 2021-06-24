<?php
  namespace App\Controllers;

  use App\Lib\Sessao;

  abstract class Controller {
    //Atributo aoo responsavel por receber objeto da classe app

    protected $app;
    private $viewVar; //Atributo viewVar responsável para injetar array de informações para view

    public function render($view) {
      //Pega o array de informações e envia para a view
      $viewVar = $this->getViewVar();
      $Sessao = Sessao::class;

      require_once PATH . '/App/Views/layouts/header.php'; //Utiliza a função require_once para incluir arquivo header.php
      require_once PATH . '/App/Views/layouts/menu.php'; //Utiliza a função require_once para incluir arquivo menu.php
      require_once PATH . '/App/Views/' . $view . '.php'; //Utiliza a função require_once para incluir um arquivo que o nome sera definido atraves do atributo $view passado no metodo render
      require_once PATH . '/App/Views/layouts/footer.php'; //Utiliza a função require_once para incluir arquivo footer.php
    }

    public function redirect($view) {
      //Método utilizado para redirecionar utilizando a função header nativa do PHP
      header('Location: http://' . APP_HOST . $view); // Header é usado para enviar um cabeçlho HTTP britp. como um redirecionamento, um cabeçalo JSON
      exit; //Saí da aplicação (pra evitar caca)
    }

    public function getViewVar() {
      //Método utilizado para retornar informações unjetadas na view
      return $this->viewVar;
    }

    //Método utilizado para injetar infrmações na view 
    public function setViewParam($varName, $varValue) {
      //Monta um array com as informações passadas pelo método.
      if($varName != "" && $varValue != "") {
        $this->viewVar[$varName] = $varValue;
      }
    }
  }
?>