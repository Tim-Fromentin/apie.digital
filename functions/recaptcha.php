<?php

class Recaptcha{
    private $secret;

    function __construct($secret)
    {
        $this->secret = $secret; // Correction ici : $this->secret au lieu de $this->$secret
    }

    public function checkCode($code){
        if(empty($code)) {
            return false;
        }

        $url = "https://www.google.com/recaptcha/api/siteverify?secret={$this->secret}&response={$code}";

        if(function_exists('curl_version')){
            $curl = curl_init($url);

            curl_setopt($curl, CURLOPT_HEADER, false);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_TIMEOUT, 1);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);
        } else {
            $response = file_get_contents($url);
        }
        if(empty($response) || is_null($response)) {
            return false;
        }

        $json = json_decode($response);
        return $json->success;

    }
}


?>