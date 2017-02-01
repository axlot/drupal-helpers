<?php

class NodeDetailHelper {
	var $node;
	var $nid;

	function __construct($node)
	{

      	$this->node = $node;

      	if (is_object($node)) {
      		$this->nid = $node->nid;
      		$this->node = $node;
    	} else {
    		$this->nid = $node;
    		$this->node = node_load($node);
    	}
    }

     /* Node Common Fields*/
    public function getTitle() {
    	return $this->node->title;
    }

    public function getType() {
    	return $this->node->type;
    }

    public function getBody($trimmed = NULL) {

    	$settings = 'default';

    	if ($trimmed) {
    		$display = array(
				'label'=>'hidden', 
				'type' => 'text_summary_or_trimmed', 
				'settings'=> array('trim_length' => $trimmed),
			);
			$body = render(field_view_field('node', $this->node, 'body', $display));
    	} else {
    		$body = TextFieldHelper::getValue('node', $this->node, 'body');
    	}

    	return $body;
    }

    function getPermalink() {
    	return url('node/' . $this->nid);
    }

    /* ICMA Content Type Common Fields */

    function getBannerImage() {
    	return ImageFieldHelper::getValue('node', $this->node, 'field_banner_image');
    }

    function getLeadImage() {
    	return ImageFieldHelper::getValue('node', $this->node, 'field_lead_image');
    }

    function getRelatedTopics() {
    	$topics = FieldHelper::getValues('node', $this->node, 'field_related_topics');
    	$topics_list = array();
    	foreach($topics as $topic) {
    		$topics_list[$topic['tid']] = $topic['taxonomy_term'];
    	}
    	return $topics_list;
    }

    function getRelatedContent() {
        $related_content = FieldHelper::getValues('node', $this->node, 'field_related_content');
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
        return TextFieldHelper::getValue('node', $this->node, 'field_'.$field_name, false);
    }
}