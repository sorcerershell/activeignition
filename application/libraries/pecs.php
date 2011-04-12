<?php

require_once APPPATH."/libraries/vendor/pecs/lib/pecs.php";

class Pecs 
{
  static $spec_dir  = "/specs/";
  var $spec_files   = array();
  
  function __construct()
  {

  }
  
  function add_specification($spec_file)
  {
    $this->add_spec($spec_file);
  }
  
  function add_spec($spec_file)
  {
    $spec_fullpath = APPPATH.self::$spec_dir.$spec_file.".php";
    
    if( ! is_file($spec_fullpath))
      throw new SpecFileNotFoundException("Specification File Not Found");
      
    $this->spec_files[] = $spec_fullpath;
  }
  
  function run()
  {
    if(count($this->spec_files) == 0)
      throw new NoSpecFilesFoundException("No Specification Files Added");
    
    foreach($this->spec_files as $spec_file)
      require_once "$spec_file";
    
    \pecs\run(new \pecs\HtmlFormatter());
  }
}

class SpecFileNotFoundException extends Exception { }
class NoSpecFilesFoundException extends Exception { }