<?PHP
class userController extends controller{
  public function __construct() {
    $this->data = array(
      'success' => '',
      'title' => 'Usuario'
    );
  }

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL.'login');
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

  public function saveUserInfo() {
    $name = addslashes($_POST['usrName']);
    $id = addslashes($_POST['usrId']);
    $email = addslashes($_POST['usrEmail']);
    $permission = addslashes($_POST['permission']);

    $u = new Usuarios();
    $u->updateInfo($name, $id, $email, $permission);

    $this->data['success'] = 'yes';

    echo json_encode($this->data);
    exit;
  }

}
?>
