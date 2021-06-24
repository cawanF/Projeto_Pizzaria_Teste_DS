<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
        <h3>Cadastro de Usuário</h3>
        <!--Nesta condição validamos se existe alguma mensagem da sessão.-->
        <?php if($Sessao::retornaMensagem()){ ?>
          <!-- Criamos o box de alerta do Bootstrap, exibindo a mensagem gravada na sessão.-->
          <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
        <?php } ?>
        <!--Repare que nesta linha temos a constante APP HOST, que foi definida na classe principal App,
        pois a nossa aplicação pode funcionar direto em um host “/” ou em um diretório.-->
        <form action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post" id="form cadastro">
          <div class="form-group">
            <label for="nome">Nome</label>
            <!--Neste campo texto definimos que o atributo valuereceberá a informação que vem da sessão da aplicação. Caso o usuário tenha algum problema ao enviar o formulário, as informações retornam para view.-->
            <input type="text" class="form-control" name="nome" placeholder="Seu nome" value="<?php echo $Sessao::retornaValorFormulario ('nome'); ?>" required>
          </div>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" name="email" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Salvar</button>
        </form>
      </div>
      <div class=" col-md-3"></div>
  </div>
</div>