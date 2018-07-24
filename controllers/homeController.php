<?PHP 

class homeController extends controller {
  
  public function index() {

    if(empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL.'login');
      exit;
    }

    //***Only for demo***//
//    $_SESSION['cLogin'] = 9;
//    $_SESSION['nome-usuario'] = 'user';
//    $_SESSION['permission'] = '';

    $data = array(
      'title' => 'Home'
    );

    $this->loadTemplate('home', $data);
  }
  
}

?>
