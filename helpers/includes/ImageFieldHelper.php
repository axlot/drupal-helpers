<?php 

class ImageFieldHelper extends FieldHelper {
	public static function getValue($entity_type, $entity, $field_name)
      {
      $field_value = parent::getValue($entity_type, $entity, $field_name);
      if (function_exists('simplecrop_crop_load')) {
          $cropped =  simplecrop_crop_load($field_value['uri']);
          if (!empty($cropped)) {
              $field_value['uri'] = $cropped->uri;
              return (!empty($field_value['uri'])) ?  image_style_url($field_name, $field_value['uri']) : FALSE;
          }
      }
      return (!empty($field_value['uri'])) ? file_create_url($field_value['uri']) : FALSE;
  	}
}