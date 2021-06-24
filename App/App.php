<?php

  namespace App;

  use App\Controllers\HomeController;
  use Exception;

  class App {
    //Variável responsável por armazenar o objeto do controller selecionado
    private $controller; 
    private $controllerFile; //Variável responsável por armazenar o nome do controller a ser executado
    private $action; //Variável responsável por armazenar o nome da action
    private $params; //Variável responsável por armazenar os parâmetros da aplicação
    private $controllerName; //Variável responsável por armazenar o nome do controller

    public function __construct() {
      //Constantes do sistema
      //Constante responsável por armazenar qual diretório a aplicação vai ser rodada
      

      define('APP_HOST', $_SERVER['HTTP_HOST'] . "/DS/Projeto-Teste-PWII/projeto3");
      define('PATH', realpath('./')); //Constante responsável por armazenar o PATH para utilização interna da aplicação
      define('TITLE', "Primeria Aplicação MVC com Banco de Dados"); //Constante responsável por armazenar o título da aplicação. Caso queria utilizar novas constantes é só incluir neste constructor
      define('DB_HOST', "localhost"); //Constante responsável por armazenar o host da conexão com o banco de dados
      define('DB_USER', "root"); //Constante responsável por armazenar o usuário da conexão com o banco de dados
      define('DB_PASSWORD', "usbw"); //Constante responsável por armazenar a senha da conexão com o banco de dados
      define('DB_NAME', "db_mvc"); //Constante responsável por armazenar o nome do banco de dados
      define('DB_DRIVER', "mysql"); //Constante responsável por armazenar o driver de conexão com o banco de dados
      define('DB_PORT', '3307');//MODIFICAÇÃO: uma porta foi necessário no nosso caso

      $this->url(); //Execução do Método para tratar URL amigável
    }

    public function run () {
      if($this->controller) { //Verifica se tem algum controlador definido através do atributo controller
        $this->controllerName = ucwords($this->controller) . 'Controller'; //Caso exista, trata o resultado utilizando a função ucwords, convertendo para maiúsculas o primeiro caractere, concatenando com palavra Controller.
        $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName); //Utiliza a expressão regular para remover qualquer caractere diferente de (A até Z e a até z).
      } else {
        $this->controllerName = "HomeController"; //Se não encontrar nenhum Controller, por padrão, o atributo controller recebe "HomeController"
      }

      $this->controllerFile = $this->controllerName . '.php'; //O atributo controllerFile recebe o nome da classe controller e concatena com a extensão PHP para que seja verificada a existência deste arquivo mais a frente.
      $this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action); //O atributo action recebe o sue nome  a expressão regular para remover qualquer caractere diferente de (A até Z e a até z).

      if(!$this->controller) { //Caso o atributo controller não tenha sido definido, a aplicação instanciará HomeController
        $this->controller = new HomeController($this); //O atributo controller vai receer a instância do HomeController
        $this->controller->index(); //O objeto executará index por padrão
      }

      if(!file_exists(PATH . "\\App\\Controllers\\" . $this->controllerFile)) { //Verifica se arquivo da classe controller solicitada existe
        throw new Exception("Página Não encontrada.", 404);//Se não existir, vai ser executada uma execução no sistema
      }

      $nomeClasse = "\\App\\Controllers\\" . $this->controllerName; //A variável $nomeClasse recbe o nome com caminho completo da classe controller
      $objetoController = new $nomeClasse($this); //a variável objetoController recebe a instância do objeto controller solicitado

      if(!class_exists($nomeClasse)) {//Verifica se o nome da classe solicitada existe através da função nativa do PHP
        throw new Exception("Erro na aplicação", 500); //Caso não exista, vai ser executada uma exceção no sistema.
        return;
      }

      if(method_exists($objetoController, $this->action)) {//Verifica se método da classe instanciada existe através de uma função nativa do PHP
        $objetoController->{$this->action}($this->params); //Se existir, executará o método solicitada
        return; 
      } else if (!$this->action && method_exists($objetoController, 'index')) { //Se não existir, nenhum método e a classe existir o método index será executado.
        $objetoController->index($this->params); //Se nenhuma opção for executada nesta validaçãp, vai ser executada uma exceção
        return;
      } else {
        throw new Exception("Nosso suporte já está verificando, desculpe!", 500);
      }
      throw new Exception("Página não encontrada.", 404); //Se nenhuma opção for executada vai ser executada uma excessão.
    }
    
    
    public function url() {
      //Utiliza a função isset para validar se esta variável foi criada.
      if(isset($_GET['url'])) {
        $path = $_GET['url']; //Cria a variável $url, recebendo valor da URL através do $_GET
        $path = rtrim($path, '/'); //Retira espaços em branco do final da string recebida
        $path = filter_var($path, FILTER_SANITIZE_URL); //Remove caracteres inválidos de uma URL
        
        $path = explode('/', $path); //Separa a URL através de "/" e transforma em um array com a função explode PHP.
        
        $this->controller = $this->verificaArray( $path, 0); //Atributo controller recebe o valor da prosição 0 do array. Esta será o nosso controller passado na URL.
        
        $this->action = $this->verificaArray( $path, 1); //Atributo action recebe o valor da prosição 1 do array. Esta posição será a nossa action
        
        //Verifica se existe informações na posição 2 do array. Nesta posição serão passados os nossos parâmetroa a URL.
        if($this->verificaArray($path,2)) {
          unset( $path[0] ); //Através da função unser a variável será eliminada
          unset( $path[1] );
          $this->params = array_values( $path ); //Atributo params recebe todas as posições do array, exceto das posições 0 e 1
        }
      }
    }

    public function getController() {
      return $this->controller;
    }

    public function getAction() {
      return $this->action;
    }

    public function getControllerName() {
      return $this->controllerName;
    }

    public function getParams() {
      return $this->params;
    }

    private function verificaArray($array,$key){
      if(isset($array[$key]) && !empty($array[$key])) {
        return $array[$key];
      }
      return null;
    }
  }
?>