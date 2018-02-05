<html>
  <head>
    <title>Monitoramento Meteorológico</title>
    <!-- bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/bootstrap.min.css"/>
    <!-- jQueryUI CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/jquery-ui.css"/>
    <!-- font-awesome icons -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- custom CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/style.css"/>
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
    
    <!-- jQuery library -->
    <script src="<?PHP echo BASE_URL;?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/icons8/bower-webicon/v0.10.7/jquery-webicon.min.js"></script>

    <!-- Chart.js -->
    <script src="<?PHP echo BASE_URL;?>assets/js/Chart.min.js"></script>

    <!-- bootstrap Javascript -->
    <script src="<?PHP echo BASE_URL;?>assets/js/bootstrap.min.js"></script>

    <!-- app js script -->
    <script src="<?PHP echo BASE_URL;?>assets/js/script.js"></script>
    
    <!-- load view -->
    <?PHP $this->loadViewInTemplate($viewName, $viewData);?>

    <!-- registries scripts -->
    <script src="<?PHP echo BASE_URL;?>assets/js/registries/create-registry.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/registries/delete-registry.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/registries/search-registry.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/registries/update-registry.js"></script>
  </body>
</html>
