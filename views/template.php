<html>
  <head>
    <title><?PHP echo $title;?> - Monitoramento Meteorológico</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- bootstrap CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/bootstrap-material-design.min.css"/>
    <!-- Material UI framework -->
    <link href="//cdn.muicss.com/mui-0.9.39-rc1/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQueryUI CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/jquery-ui.css"/>
    <!-- font-awesome icons -->
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!-- custom CSS -->
    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/style.css"/>

    <link type="text/css" rel="stylesheet" href="<?PHP echo BASE_URL;?>assets/css/style-add-registry.css"/>
  </head>
  <body>

    <?PHP if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])): ?>
    <nav class="navbar navbar-expand">
      <div class="container-fluid">
        <button class="btn show-sidebar">
          <i class="material-icons">search</i>
        </button>
        <div class="navbar-header"> 
          <a href="<?PHP echo BASE_URL; ?>" class="navbar-brand ml-3">Monitoramento</a>
        </div>
        <div class="navbar-nav navbar-right ml-auto mr-3">
          <div class="nav-item dropdown btn-group">
            <a class="nav-link dropdown-toggle d-none d-sm-block" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?PHP echo $_SESSION['nome-usuario']?>
            </a>
            <a class="btn bmd-btn-icon dropdown-toggle d-sm-none" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">more_vert</i>
            </a>
            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
              <a  class="dropdown-item" href="<?PHP echo BASE_URL; ?>user/?usr=<?PHP echo $_SESSION['cLogin']; ?>">Meus dados</a>
            <?PHP
              if($_SESSION['permission'] == 'admin'):
            ?>
              <a  class="dropdown-item" href="<?PHP echo BASE_URL; ?>admin">Usuarios</a>
            <?PHP endif; ?>
              <a  class="dropdown-item" href="<?PHP echo BASE_URL; ?>login/sair">Sair</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <?PHP endif; ?>
    
    <!-- jQuery library -->
    <script src="<?PHP echo BASE_URL;?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/icons8/bower-webicon/v0.10.7/jquery-webicon.min.js"></script>

    <!-- moment.js and Chart.js -->
    <script src="<?PHP echo BASE_URL;?>assets/js/moment.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/Chart.min.js"></script>

    <!-- bootstrap Javascript and Popper.js-->
<!--    <script src="<?PHP //echo BASE_URL;?>assets/js/bootstrap.min.js"></script>-->
    <script src="<?PHP echo BASE_URL;?>assets/js/popper.min.js"></script>
    <script src="<?PHP echo BASE_URL;?>assets/js/bootstrap-material-design.min.js"></script>

    <!--   Material UI framework   -->
    <script src="//cdn.muicss.com/mui-0.9.39-rc1/js/mui.min.js"></script>


    <!-- app js script -->
    <script type="text/javascript">var baseUrl = "<?php echo BASE_URL; ?>";</script>
    <script src="<?PHP echo BASE_URL;?>assets/js/script.js"></script>
    
    <!-- load view -->
    <?PHP $this->loadViewInTemplate($viewName, $viewData);?>
  </body>
</html>
