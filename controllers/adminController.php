<?PHP
class adminController extends controller{
  public function __construct() {
    $this->data = array(
      "success" => '',
      'title' => 'Admin'
    );
  }

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }


    //LOADS TEMPLATE
    $this->loadTemplate('admin', $this->data);
  }

  public function users() {

    //Nomes Usuarios
    $u = new Usuarios();
    $users = $u->getLista();

    $this->data['users'] = $users;

    echo json_encode($this->data);
    exit;
  }

}
?>
