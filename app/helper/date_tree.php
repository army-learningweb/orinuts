<?php

function data_tree($arr,$parent_id = 0,$level = 0){
    $result = [];
    foreach($arr as $item){
        if($item['parent_id'] == $parent_id){

            $item['level'] = $level;

            $result[] = $item;
            
            $child = data_tree($arr,$item['id'],$level + 1);

            $result = array_merge($result,$child);
        }
    }
    return $result;
}