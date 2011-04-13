<?php

function row_dump($record)
{
  var_dump((array)$record);
}

function link_to_view($record)
{  
  $class_name = strtolower(get_class($record));
  
  if(!empty($record->slug))
    return '/'.pluralize($class_name).'/slug/'.$record->slug;
  
  return '/'.pluralize($class_name).'/view/'.$record->id;
}

function link_to_edit($record)
{  
  $class_name = strtolower(get_class($record));
  
  return '/'.pluralize($class_name).'/edit/'.$record->id;
}


function link_to_save($record)
{  
  if ( ! is_object($record) ) return '';
 
  $class_name = strtolower(get_class($record));
  
  return '/'.pluralize($class_name).'/save/'.$record->id;
}

function link_to_create($record)
{  
  if ( ! is_object($record) ) return '';
 
  $class_name = strtolower(get_class($record));
  
  return '/'.pluralize($class_name).'/create';
}

function link_to_delete($record)
{  
  if ( ! is_object($record) ) return '';
 
  $class_name = strtolower(get_class($record));
  
  return '/'.pluralize($class_name).'/delete/'.$record->id;
}

function build_options_for($rows, $first='', $last='', $field_names = array('name'))
{
  if ( ! is_object($rows) ) return $first;

  $options = array( );
  $options[0] = $first;
  foreach($rows as $row)
  {
    $name = '';
    foreach ($field_names as $field)
      $name .= $row[$field].' - ';
    $options[$row['id']] = $name;
  }

  $options[] = $last;
  return $options; 
}

function respond_for( $type, $view, $data = array() )
{
  $CI = &get_instance();

  if($CI->router->format == $type)
  {
    switch($type) {
      case ".php":
        $CI->load->view($view, $data);
        break;
      case "html": 
        if( is_ajax() )  {
         $CI->layout->no_layout();
         $CI->load->view($view, $data); 
         $CI->layout->use_layout();
        } else {
          $CI->load->view($view, $data);
        }
        break;
      case "js":
        echo json_encode($view);
        break;
      case "xml":
        /** TODO: encode variable into xml stream */
        break;
      default:
        $CI->load->view($view, $data);
        break;
    }
  }  
}

function is_front()
{
  $CI = &get_instance();

  if($CI->router->fetch_class() == 'front')
    return true;

  return false;
}

function pager_links()
{
  $CI = &get_instance();
  
  $CI->pager->getDisplay();
}


