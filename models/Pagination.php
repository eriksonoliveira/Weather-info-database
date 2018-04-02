<?PHP
class Pagination extends model {
  public function getTotalPages($query, $items_per_page) {
    $total = '';
    $total_pages = '';

    $query->execute();

    if($query->rowCount() > 0) {
      $query = $query->fetchAll(PDO::FETCH_ASSOC);
      $total = count($query);
    }

    $total_pages = $total / $items_per_page;

    return $total_pages;
  }

  public function getStart($page, $items_per_page) {
    $start = ($page - 1) * $items_per_page;

    return $start;
  }
}
?>
