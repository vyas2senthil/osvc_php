<?php

namespace OSvCPHP;
use OSvCPHP;

require_once("Client.php");

class Connect extends Client
{

	static function get($options)
	{
		return self::_curl_generic($options,"GET");
	}	

	static function post($options)
	{
		return self::_curl_generic($options,"POST");
	}	

	static function patch($options)
	{
		return self::_curl_generic($options,"PATCH");	
	}	

	static function delete($options)
	{
		return self::_curl_generic($options,"DELETE");	
	}

	private static function _curl_generic($options, $method = "GET")
	{
		$client_hash = $options['client'];
		$resource_url = $options['url'];

		$resource_url_final = isset($resource_url) ? rawurlencode($resource_url) : "";
		$url = $client_hash->config->base_url . $resource_url;
		$curl = curl_init();
		$headers = array(
			"Content-Type: application/json",
			"Authorization: Basic " . $client_hash->config->login,
			"Connection: Keep-Alive",
			"Keep-Alive: timeout=1, max=1000"
		);
		if($client_hash->config->suppress_rules) array_push($headers,"OSvC-CREST-Suppress-All : true");
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, !$client_hash->config->no_ssl_verify);
		curl_setopt($curl, CURLOPT_POST, ($method == "POST")); 
		if (($method == "POST" || "PATCH") && isset($options['json'])) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($options['json']));
		if ($method == "PATCH"){
			array_push($headers,"X-HTTP-Method-Override: PATCH");
		}else if($method == "DELETE"){
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		}
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		return self::_run_curl($curl, $options);
	}

	private static function _run_curl($curl, $options){
		
		$body = json_decode(curl_exec($curl));
		$info = curl_getinfo($curl);
		curl_close($curl);

		if(isset($options['debug']) && $options['debug'] === true){
			$final_results =  array(
				'body' => $body,
				'info'=> $info
			);
			return $final_results;
		}else{
			return $body;
		}
	}
}

