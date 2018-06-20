<?PHP
class pesquisarController extends controller{
  public function __construct() {
    $this->data = array(
      'title' => 'Pesquisar'
    );
  }

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL.'login');
      exit;
    }

    $s = new Sistemas();
    $sist = $s->getLista();

    $this->data['sistemas'] = $sist['sistemas_list'];
    $this->data['sistemas_class'] = $sist['sistemas_class'];

    //LOADS TEMPLATE
    $this->loadTemplate('search', $this->data);
  }

  public function data() {
    if(empty($_SESSION['cLogin'])) {
      header('Location: '.BASE_URL.'login');
      exit;
    }

    $data = array();

    if(isset($_POST['dateStart']) && !empty($_POST['dateStart'])) {
      $start = addslashes($_POST['dateStart']);
      $end = addslashes($_POST['dateEnd']);
      $page = addslashes($_POST['page']);
      if(isset($_POST['systems'])) {
        $systems = $_POST['systems'];
        $systems = json_decode($systems, true);
      }

      $s = explode('-', $start);
      $e = explode('-', $end);

      $startDate = $s[2].'-'.$s[1].'-'.$s[0];
      $endDate = $e[2].'-'.$e[1].'-'.$e[0];

      //Number of items for pagination
      $items_per_page = 10;

      $r = new Registros();
      $data['result'] = $r->searchRegistry($startDate, $endDate, $systems, $page, $items_per_page);
    }

    //SENDS DATA IN JSON FORMAT
    echo json_encode(array_values($data));
    exit;
  }

}
?>
