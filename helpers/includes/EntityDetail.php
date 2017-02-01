<?php

class EntityDetail {
	var $entity;
	var $entity_id;
    var $type;

	function __construct($entity_id, $entity_type = 'node')
	{
    	$this->entity_id = $entity_id;
        $this->type = $entity_type;
    	$this->entity = EntityHelper::loadSingle($this->type, $this->entity_id);
    }

     /* Node Common Fields*/
    public function getTitle() {
    	return $this->entity->title;
    }

    public function getType() {
    	return $this->type;
    }

    public function getBody($trimmed = NULL) {

    	$settings = 'default';

    	if ($trimmed) {
    		$display = array(
				'label'=>'hidden', 
				'type' => 'text_summary_or_trimmed', 
				'settings'=> array('trim_length' => $trimmed),
			);
			$body = render(field_view_field($this->type, $this->node, 'body', $display));
    	} else {
    		$body = TextFieldHelper::getValue($this->type, $this->node, 'body');
    	}

    	return $body;
    }

    function getPermalink() {
    	return url( $this->type .'/' . $this->nid);
    }

    /* ICMA Content Type Common Fields */

	function getBannerImage() {
    	return ImageFieldHelper::getValue($this->type, $this->entity, 'field_banner_image');
    }

    function getLeadImage() {
    	return ImageFieldHelper::getValue($this->type, $this->entity, 'field_lead_image');
    }


    function getRelatedTopics() {
    	$topics = FieldHelper::getValues($this->type, $this->entity, 'field_related_topics');
    	$topics_list = array();
    	foreach($topics as $topic) {
    		$topics_list[$topic['tid']] = $topic['taxonomy_term'];
    	}
    	return $topics_list;
    }

    function getRelatedContent() {
        $related_content = FieldHelper::getValues($this->type, $this->entity, 'field_related_content');
        $related_content_list = array();
        foreach($related_content as $related_content_node) {
            if (isset($related_content_node['target_id'])) {
                $related_content_list[] = node_load($related_content_node['target_id']);
            }
        }
        return $related_content_list;
    }


    /* Try to load a text field if no particular method exists */
    public function __call($name, $arguments) {
    	$name = substr($name, 3);
    	$field_name = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1_', $name));
        return TextFieldHelper::getValue($this->type, $this->entity, 'field_'.$field_name, false);
    }
}