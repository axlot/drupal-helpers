<?php 

class UrlFieldHelper extends FieldHelper {
	public static function getValue($entity_type, $entity, $field_name)
    {
      $field_value = parent::getValue($entity_type, $entity, $field_name);

      if (empty($field_value['title'])) {
      	$field_value['title'] = "READ MORE";
      }

      return (!empty($field_value['value'])) ? array('url' => $field_value['value'], 'title' => $field_value['title']) : FALSE;
  	}
}