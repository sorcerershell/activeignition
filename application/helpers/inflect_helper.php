<?php
  
function pluralize($string)
{
  $CI = &get_instance();
  return $CI->inflect->pluralize($string);
}