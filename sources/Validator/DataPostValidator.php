<?php

namespace App\Validator;

class DataPostValidator {
    static public function validate(array $post, array $arrRegisterKeys)
    {
       
        $response = ["error" => false, "msg" => []];;
        
        if(empty($post)) return ["error" => true, "msg" => []];

        foreach($arrRegisterKeys as $key) {
            if(empty($post[$key])) {
                $response["error"] = true;
                $response['msg'][] = "le champ $key est obligatoire";
            }
        }
     
        return $response;        
    }
}