<?PHP
class notfoundController extends controller{
  public function __construct() {
    $this->data = array(
      'success' => '',
      'title' => '404 - Page Not Found'
    );
  }

  public function index() {

    //LOADS TEMPLATE
    $this->loadTemplate('notfound', $this->data);
  }

}
?>
