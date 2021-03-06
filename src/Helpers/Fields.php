<?php

namespace Gpd\Helpers;

/**
 * This class is responsible by mount fields in 
 * query and mutation main type Classes
 */
class Fields 
{

    /**
     * Get Fields from Type of Api to Schema Function
     * @param string $functionName
     */
    public static function getFields(string $functionName)
    {
        $fields = [];
        $filesList = \Gpd\Helpers\File::getDirectoryFiles('/Type/ApiTypes');
        foreach($filesList as $file){
            if(!strpos($file, 'Type.php')){
                continue;
            }
            $className = substr($file, 0, -4);
            $fullName = '\Gpd\Type\ApiTypes\\' . $className . '::' . $functionName;
            // Check if method is callable
            if(!is_callable(['\Gpd\Type\ApiTypes\\' . $className, $functionName])){
                continue;
            }
            $field = $fullName();
            if(!$field){
                continue;
            }
            foreach($field as $key=>$value){
                $fields[$key] = $value;
            }
            
        }
        return $fields;
    }

}