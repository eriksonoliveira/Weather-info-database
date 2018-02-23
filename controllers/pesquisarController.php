<?PHP
class pesquisarController extends controller{

  public function index() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }

    $data = array(
      'title' => 'Pesquisar'
    );

    $s = new Sistemas();
    $sist = $s->getLista();

    $data['sistemas'] = $sist['sistemas_list'];
    $data['sistemas_class'] = $sist['sistemas_class'];

    //LOADS TEMPLATE
    $this->loadTemplate('search', $data);
  }

  public function data() {
    if(empty($_SESSION['cLogin'])) {
      header("Location: ".BASE_URL."login");
      exit;
    }


    $data = array();

    if(isset($_POST['dateStart']) && !empty($_POST['dateStart'])) {
      $start = addslashes($_POST['dateStart']);
      $end = addslashes($_POST['dateEnd']);
      if(isset($_POST['systems'])) {
        $systems = $_POST['systems'];
        $systems = json_decode($systems, true);
      }

      $s = explode("/", $start);
      $e = explode("/", $end);

      $startDate = $s[2]."-".$s[0]."-".$s[1];
      $endDate = $e[2]."-".$e[0]."-".$e[1];

      $r = new Registros();
      $data['result'] = $r->searchRegistry($startDate, $endDate, $systems);

      /*$data['result'] = "start: ".$startDate. ", End: ". $endDate;*/
    }

    //SENDS DATA IN JSON FORMAT
    echo json_encode(array_values($data));
    exit;
  }

}
?>
