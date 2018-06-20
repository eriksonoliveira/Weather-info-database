<?PHP
class adminController extends controller{
  public function __construct() {
    $this->data = array(
      'success' => '',
      'title' => 'Admin'
    );
  }

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL.'login');
      exit;
    }


    //LOADS TEMPLATE
    $this->loadTemplate('admin', $this->data);
  }

  public function users() {
    $page = addslashes($_POST['page']);

    //Users' names
    $u = new Usuarios();

    $users_per_page = 5;
    $users = $u->getListaTable($page, $users_per_page);

    $this->data['users'] = $users;

    echo json_encode($this->data);
    exit;
  }

}
?>
