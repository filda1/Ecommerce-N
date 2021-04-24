<?php

namespace App;

class XDHelper
{
    public function makeRequest($vars){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, env('XD_API'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);

        $output = curl_exec($ch);

        curl_close($ch);

        $info = json_decode($output, true);

        if (json_last_error() === JSON_ERROR_NONE) {
        	return $info;
        }else{
            return "error on server";
        }
    }
}
