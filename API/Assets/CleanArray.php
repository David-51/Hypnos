<?php
/**
 * @param $array, array to securise form injection.
 */
function CleanArray($array){
    return array_map(function ($value){
        $newvalue = strip_tags($value);
        return trim($newvalue);
        }, $array);
}