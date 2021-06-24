<?php

  namespace App\Controllers;

  use App\Lib\Sessao;
  use App\Models\DAO\UsuarioDAO;
  use App\Models\Entidades\Usuario;

  class UsuarioController extends Controller {

    public function cadastro() { //Chamamos o método da classe pai para renderizar e passamos como parâmetro a view que queremos renderizar
      $this->render('usuario/cadastro');
      //Caso exista algum formulário em sessão usamos a método da classe Sessao para poder limpar o formulário
      Sessao::limpaFormulario();
      Sessao::limpaMensagem(); //Caso exista alguma mensagem em sessão usamos a método da classe Sessao para limpar a mensagem gravada
    }

    public function salvar() {
      var_dump($_POST);
      $Usuario = new Usuario(); //Primeiro vamos instanciar o objetivo do usuário
      $Usuario->setNome($_POST['nome']); //Vamos setar a a informação para o objeto usuário. Todas estas informações são recebidas através da variável "superglobal" $_POST

      $Usuario->setEmail($_POST['email']);

      Sessao::gravaFormulario($_POST); //Salvaremos as informações na sessão. Serão Gravadas todas as informações do formulário antes de gravar no banco de dados, caso precise recuperar o formulario na view.

      $usuarioDAO = new UsuarioDAO(); //Instanciamos a classe UsuarioDAO que vai efetuar a persistência com o banco de dados.

      if($usuarioDAO->verificaemail($_POST['email'])) {//Instanciamos a classe UsuarioDAo que vai efetuar a persistência com o banco de dados
        Sessao::gravaMensagem("Email existente"); //Caso este email exista, será gravdo na sessão uma mensagem de erro para exibir ao usuário na view
        $this->redirect('/usuario/cadastro');
      }

      if($usuarioDAO->salvar($Usuario)) {// Executa o médtodo para salvar passando o objeto do usuário e verifica se foi executada com sucesso
        $this->redirect('/usuario/sucesso'); //Redireciona para a tela de sucesso exibindo uma mesnafem com o nome cadastrado
      } else {
        Sessao::gravaMensagem("Erro ao gravar"); //Registra uma mensagem de erro
      }
    }

    public function sucesso() {
      if(Sessao::retornaValorFormulario('nome')) {//Validar e verificar se existe a informação na sessão do nome do usuário, que foi preenchida no formulário. O mesmo fica armazenado na sessão e será eliminado após renderizar a página de sucesso
        
        $this->render('/usuario/sucesso'); //Renderiza a viws sucesso e exibe o nome do usuário que foi preenchido no fomulário

        Sessao::limpaFormulario(); //Limpa formulário que está na sessão para que no próximo cadastro não fiquem informações antigas.

        Sessao::limpaMensagem(); // Limpa a mensagem da sessao, caso exista uma mensagem de aviso

      } else {
        $this->redirect('/'); //Caso seja dado um refresh na rela não vai mais existir a informação do formulário, pois a mesma doi limpa após renderizar. Se tentar renderizar a página sucesso e não existir informações do usuário, a mesma será redirecionada para a página principal
      }
    }

    public function index(){
      $this->redirect('/usuario/cadastro'); // Esta linha vai redirecionar para a a tela de cadstro do usuário O arquico index.php da view usuário não existe, por isso a action apenas redireciona quando acessada.
    }
  }
?>