<?php

$CI = &get_instance();

if( ! defined('__LAYOUT_CONFIG__')) $CI->load->config('layout');
if( ! defined('__LAYOUT_LIB__'))    $CI->load->library('layout');


function placeholder($name)
{
  $CI = &get_instance();
  return $CI->layout->placeholder($name);  
}

function stylesheet($name)
{
  $path = base_url().config_item('stylesheets').$name;

  $tag = "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$path}\" />\n";
  
  return $tag;
}

function javascript($name)
{
  $path = base_url().config_item('javascripts').$name;
  $tag = "<script language=\"javascript\" type=\"text/javascript\" src=\"{$path}\"></script>";
  
  return $tag;
}


function title($the_title)
{
  $CI = &get_instance();
  
  $title = '<title>' . $the_title . '</title>' . "\n";
  
  return $CI->layout->placeholder('title', $title);    
}

function partial($view_name, $data=array())
{
  $CI = &get_instance();
  $layout_name = $CI->layout->get_layout();
  $CI->layout->no_layout();

  $CI->load->view($view_name, $data);
  
  $CI->layout->use_layout($layout_name);
}
