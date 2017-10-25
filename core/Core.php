<?PHP 

class Core {
  
  public function run() {
    
    $url = '/';
    if(isset($_GET['url'])) {
    $url .= $_GET['url'];
    }
    
    $params = array();
    if(!empty($url) && $url != '/') {
      $url = explode('/', $url);
      array_shift($url); //Remove first element of $url
      
      $currentController = $url[0].'Controller';
      array_shift($url);
      
      if(isset($url[0]) && !empty($url[0])) {
        $currentAction = $url[0];
        array_shift($url);
      } else {
        $currentAction = 'index';
      }
      
      if(count($url) > 0) {
        $params = $url;
      }

    } 
    else {
      $currentController = 'homeController';
      $currentAction = 'index';
    }

    $c = new $currentController();
    
    //Run the $currentAction method of $c with the parameters
    //used when the name of the method is not known
    call_user_func_array(array($c, $currentAction), $params);
  }
}
?>