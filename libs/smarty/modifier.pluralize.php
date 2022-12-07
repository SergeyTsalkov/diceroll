<?php
function smarty_modifier_pluralize($number, $singular, $plural) {
  return $number == 1 ? "$number $singular" : "$number $plural";
}