<?php

class TaxonomyTermHelper extends fieldHelper{


	public static function getValue($entity_type, $entity, $field_name, $name_only = FALSE, $column = NULL, $delta = 0) {
    $items = static::getValues($entity_type, $entity, $field_name, $column);
	    if (isset($items[$delta])) {
	       if ($name_only){
	         return static::getName($items[$delta]);
	       }
	      return static::load($items[$delta]);
	    }
	}

	public static function load($tid) {
		if (is_array($tid)) {
			return taxonomy_term_load_multiple($tid);
		} else {
			return taxonomy_term_load($tid);
		}
	}

	public static function getName($term) {
		if (isset($term['tid'])) {
			$term = static::load($term['tid']);
		}
		return (is_object($term)) ? $term->name : FALSE;
	}
}