<html>
  <head>
    <title>Monitoramento Meteorológico</title>
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/style.css"/>
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/bootstrap.min.css"/>
  </head>
  <body>

    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="<?PHP echo BASE_URL; ?>" class="navbar-brand">Monitoramento</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <?PHP if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
            <li><a href=""><?PHP echo $_SESSION['nome-usuario']?></a></li>
            <li><a href="<?PHP echo BASE_URL; ?>login/sair">Sair</a></li>    
          <?PHP else:  ?>
            <li><a href="<?PHP echo BASE_URL; ?>cadastrar">Cadastre-se</a></li>
            <li><a href="<?PHP echo BASE_URL; ?>login">Login</a></li>
          <?PHP endif; ?>
        </ul>
      </div>
    </nav>
    
    <?PHP $this->loadViewInTemplate($viewName, $viewData);?>
    
    <script src="<?PHP echo BASE_URL;?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/bootstrap.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/script.js"></script>
    
  </body>
</html>