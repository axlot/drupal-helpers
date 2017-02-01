<?php 

class TextFieldHelper extends FieldHelper {
	public static function getValue($entity_type, $entity, $field_name, $safe = true)
    {
      $field_value = parent::getValue($entity_type, $entity, $field_name);
      if (!empty($field_value['value'])) {
        if ($safe)  {
          return $field_value['safe_value'];
        } else {
          return $field_value['value'];
        }
      } else {
        return false;
      }
  	}
}