<nav class="navbar navbar-inverse navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>">MVC</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li <?php if($viewVar['nameController'] == "HomeController") { ?> class="active" <?php } ?>>
          <a href="http://<?php echo APP_HOST; ?>" >Home</a>
        </li>
        <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="active" <?php } ?>>
          <a href="http://<?php echo APP_HOST; ?>/usuario/cadastro" >Cadastro de Usuário</a>
        </li>
      </ul>
    </div>
  </div>
</nav>