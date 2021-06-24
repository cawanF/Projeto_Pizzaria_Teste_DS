<?php
	namespace App\Lib;

	use Exception;

	class Erro {
		private $message;
		private $code;

		public function __construct($objetoException = Exception::class) {
			$this->code = $objetoException->getCode();

			$this->message = $objetoException->getMessage();
		}

		public function render() {
			//variável responsável por injetar informação na view
			$varMessage = $this->message;

			//Função para verificar se o arquivo existe
			if(file_exists(PATH . "/App/Views/error/" . $this->code.".php")) {
				require_once PATH . "/App/Views/error/" . $this->code . ".php";
			} else {
				require_once PATH . "/App/Views/error/500.php";
			}

			//Finaliza a apliacação para que nada seja executado após o ero
			exit;
		}
	}
?>