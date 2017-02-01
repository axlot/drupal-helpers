<?php 

class BooleanFieldHelper extends FieldHelper {
	public static function getValue($entity_type, $entity, $field_name)
    {
      $field_value = parent::getValue($entity_type, $entity, $field_name);
      return (!empty($field_value['value']) && $field_value['value'] == 1) ? TRUE : FALSE;
  	}
}