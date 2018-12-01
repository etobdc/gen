<?php
namespace App\Helpers;

class MoipHelper{
	public static function createCustomer($token, $chave, $data){
		$url = config('constants.options.moip_url').'customers';		
		return self::http_request($token, $chave, $url, $data, 'POST');
	}

	public static function createOrder($token, $chave, $data){
		$url = config('constants.options.moip_url').'orders';		
		return self::http_request($token, $chave, $url, $data, 'POST');
	}

	public static function listCustomers($token, $chave){
		$url = config('constants.options.moip_url').'customers/';		
		return self::http_request($token, $chave, $url, null, 'GET');
	}

	private static function http_request($token, $chave, $url, $data, $type = 'POST'){
		$auth = base64_encode($token.":".$chave);
		$headers = [
		    'Content-Type:application/json',
		    'Authorization: Basic '. $auth
		];

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		if(strtoupper($type) == "POST"){
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        }elseif(strtoupper($type) == "GET"){
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        }elseif(strtoupper($type) == "DELETE"){
        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
		
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	
}