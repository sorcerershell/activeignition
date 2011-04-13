<?php

define('__LAYOUT_LIB__', true);

class Layout
{
  private $_layout;
  private $_vars;
  
  public function __construct()
  {
    $this->_layout = config_item('layout_name');
    $this->_vars = array('content' => '', 'head' => '', 'title' => '');  
  }
  
  public function use_layout($name='default')
  {
    $this->_layout = $name;
    
  }
  
  public function no_layout()
  {
    $this->_layout = false;
  }
  
  public function append($place, $content)
  {
    $this->_vars[$place] .= $content;
  }
  
  public function placeholder($place, $content=NULL)
  {
    if(is_null($content)) {
      return $this->_vars[$place];
    }
    else {
      $this->_vars[$place] = $content;
      return $this->_vars[$place];
    }
  }
  
  public function get_layout()
  {
    return $this->_layout;
  }
  
  public function get_vars()
  {
    return $this->_vars;
  }
}
