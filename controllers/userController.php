<?PHP
class userController extends controller{
  public function __construct() {
    $this->data = array(
      "success" => '',
      'title' => 'Usuario'
    );
  }

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    if(isset($_GET['usr']) && !empty($_GET['usr'])) {
      $userId = addslashes($_GET['usr']);

      $u = new Usuarios();
      $this->data['user'] = $u->getInfo($userId);

    }

    //LOADS TEMPLATE
    $this->loadTemplate('user', $this->data);
  }

}
?>
