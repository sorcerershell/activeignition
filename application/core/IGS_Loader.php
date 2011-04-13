<?php

class IGS_Loader extends CI_Loader
{
  
  function view($view_name, $view_data = array(), $return = FALSE)
  {
	
    $CI = &get_instance();

    if(!isset($CI->layout))
      $this->library('layout');
   
	  $controller       = $CI->router->fetch_class();
    $controller_view  = APPPATH.'/views/'.strtolower($controller).'/'.$view_name.'.php';
    
    if(isset($controller::$layout))
      $CI->layout->use_layout($controller::$layout);
    
    if(is_file($controller_view))
      $view_name = "{$controller}/{$view_name}";
    
    $name = $CI->layout->get_layout();
    
    // Use No Layout
    if(FALSE == $name) {  
      return parent::view($view_name, $view_data, $return);
    } else {
      // Use a Layout
      $CI->layout->placeholder(
        "content",
        parent::view($view_name, $view_data, TRUE)
      );    
           
      return parent::view(
        'layouts/'.$CI->layout->get_layout(),
        $this->layout->get_vars(),
        $return
      );
    }

  }

}
