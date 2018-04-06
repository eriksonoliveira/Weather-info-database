<?PHP 

class homeController extends controller {
  
  public function index() {

    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $data = array(
      'title' => 'Home'
    );

    $this->loadTemplate('home', $data);
  }
  
}

?>
