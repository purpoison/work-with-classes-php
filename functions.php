<?php 
    require_once __DIR__.'/index.php';

    function searchByName($array, $name){
        $isExist = false;
        foreach($array as $product){
            if(strtolower($product->getName()) == strtolower($name)){
                $isExist = true;
                $product->getProduct();
            }
        }
        if($isExist == false){
            echo "<h5> Product not found </h5>";
        }
    }

    function getData($path){
        $json_data = file_get_contents($path);
        $data = json_decode($json_data, true); 
        return $data;
    }

    function putData($data, $path){
        $json_string = json_encode($data, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        file_put_contents($path, $json_string);
    }
    function searchCategory($categories, $name){
        foreach($categories as $value){
            if (($value->getCategoryName()) == $name){
                return $value;
            }
        }
    }
?>