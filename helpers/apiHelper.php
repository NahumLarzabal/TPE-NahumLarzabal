<?php
    function base64URL_encode($data){
        return rtrim(strtr(base64_encode($data),'+/','-/'),'=');
    }

class ApiHelpers{
    private $key;

    function __construct() {
        $this->key= "Hola123BC";
    }

    function getBasic(){
        $header = $this->getHeader();
        if(strpos($header,"Basic ")===0){
            $usrpass=explode(" ",$header)[1];
            $usrpass = base64_decode($usrpass);
            $usrpass= explode (":",$usrpass);
            if(count($usrpass)==2){
                $user=$usrpass[0];
                $pass=$usrpass[1];
                return array(
                    "email"=> $user,
                    "password"=> $pass
                );
            }
        }
        return null;
    }

    function getHeader(){
        if(isset($_SERVER["REDIRECT_HTTP_AUTHORIZATION"])){
            return $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];
        }
        if(isset($_SERVER["HTTP_AUTHORIZATION"])){
            return $_SERVER["HTTP_AUTHORIZATION"];
        }
        return null;
    }


    function creatToken($user){
        $header = array(
            "type"=>'JWT',
            "alg"=>'HS256'
        );
        if($user['id'] != ""){
            $payload = array(
                "id"=>$user['id'],
                "email"=>$user['email'],
                "password"=>$user['password']
            );
        }else{
            $payload = array(
                "id"=>$user['id'],
                'name'=>$user['email'],
                "email"=>$user['email'],
                "password"=>$user['password']
            );
            var_dump($user);
        }

        $header= json_encode($header);
        $payload= json_encode($payload);
        $header = base64URL_encode($header);
        $payload = base64URL_encode($payload);
        $signature = hash_hmac("SHA256","$header.$payload",$this->key, true);
        $signature = base64URL_encode($signature);
        return "$header.$payload.$signature";
    }

    function getUser(){
        $header = $this->getHeader();
        if(strpos($header,"Bearer ")===0){
            //obtenermos el header separamos el tag del token y dividimos en puntos
         $token = explode(" ", $header)[1];
         $parts = explode(".",$token);
         //revisamos q vengan 3 partes
         if(count($parts)===3){
            $header = $parts[0];
            $payload = $parts[1];
            $signature = $parts[2];
            //ahora firmamos de nuevo para verificar que nuestra firma sea la misma
            $new_signature = hash_hmac("SHA256","$header.$payload",$this->key, true);
            $new_signature = base64URL_encode($new_signature);
            if($signature==$new_signature){
                $payload = base64_decode($payload);
                $payload = json_decode($payload);
                return $payload;
            }
         }
        }
        return null;
    }
    
}