<?php 

class ActiveIgnition_Controller extends CI_Controller 
{

  function respond($type, $data, $view)
  {
    switch($this->router->format) 
    {
      case 'html':
        $this->layout->no_layout();
        $this->load->view($view, $data);
        break;
      case 'json':
        echo json_encode($data);
        break;
      case 'xml':
        break;
      case '.php':
        $this->load->view($view, $data);
        break;
      }
  }
  
  function respond_default($view, $data)
  {
    $this->respond('.php', $data, $view);
  }
  
  function respond_json($data)
  {
    $this->respond('json', $data, NULL);
  }
  
  function respond_html($view, $data = array())
  {
    $this->respond('html', $view, $data);
  }
}
