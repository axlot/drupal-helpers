<?php

class DateFieldHelper extends FieldHelper {


	public static function formatDate($entity_name, $entity, $date_field, $format = 'm-d-Y') {
	  $formatted_time = "";
	  $items_time = field_get_items($entity_name, $entity, $date_field);
	  $first_item_time = array_shift($items_time);
	  if (isset($first_item_time['value'])) {
	    $time_date_time = new DateTime($first_item_time['value']);
	    $formatted_time = $time_date_time->format($format);
	  }
	  
	  return $formatted_time;
	}

	public static function formatTime($entity_name, $entity, $time_field, $format = 'h:i A') {
	  $formatted_time = "";
	  $items_time = field_get_items($entity_name, $entity, $time_field);
	  $first_item_time = array_shift($items_time);
	  if (isset($first_item_time['value'])) {
	    $time_date_time = new DateTime($first_item_time['value']);
	    $formatted_time = $time_date_time->format($format);
	  }
	  
	  return $formatted_time;
	}



	public static function formatDateRange($entity_name, $entity, $start_date, $end_date, $start_time = NULL, $end_time = NULL) {
	  $formatted_date = "";
	  $items_start_date = field_get_items($entity_name, $entity, $start_date);
	  $first_item_start_date = array_shift($items_start_date);
	  $start_date_date_time = new DateTime($first_item_start_date['value']);
	  $first_item_start_date_year = $start_date_date_time->format('Y');
	  $first_item_start_date_month = $start_date_date_time->format('F');
	  $start_date_date_time_day = $start_date_date_time->format('d');

	  $items_end_date = field_get_items($entity_name, $entity, $end_date);
	  $first_item_end_date = array_shift($items_start_date);
	  $end_date_date_time = new DateTime($first_item_start_date['value']);
	  $first_item_end_date_month = $end_date_date_time->format('F');
	  $end_date_date_time_day = $end_date_date_time->format('d'); 

	  if ($first_item_start_date_month == $first_item_end_date_month) {

	    if ($start_date_date_time_day == $end_date_date_time_day) {
	      $formatted_date = $first_item_start_date_month . ' ' .$start_date_date_time_day . ', ' . $first_item_start_date_year;
	    } else {
	       $formatted_date = $first_item_start_date_month . ' ' .$start_date_date_time_day . ' - ' . $end_date_date_time_day . ', ' . $first_item_start_date_year;
	    }
	    
	   
	  } else {
	    $formatted_date =  $first_item_start_date_month . ' ' .$start_date_date_time_day . ' - ' . $first_item_end_date_month . ' ' . $end_date_date_time_day . ', ' . $first_item_start_date_year;
	  }

	  return $formatted_date;

	}
}