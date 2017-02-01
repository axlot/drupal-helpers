<?php

class NodeDetailFactory {
    public static function create($node) {
        $className = ucfirst($node->type).'DetailHelper';
        if (class_exists($className)){
            return new $className($node);
        }else{
            return new NodeDetailHelper($node);
        }
    }

}
