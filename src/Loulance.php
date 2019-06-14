<?php
namespace HttpSign;

class Loulance
{

	private $check_config = [];
	private $client_config = [];
	private $signature = null;


	public function  __construct($check_config,$client_config)
	{
        $this->check_config = $check_config;
        $this->client_config = $client_config;
	}

	public function check($app,$url,$signature,$data)
	{
		if(empty($this->check_config[$app])) return false;
		$secret = $this->check_config[$app];
		return $signature == $this->make($url,$app,$secret,$data);
	}

	public function signature($app,$url,$data)
	{
		if(empty($this->client_config[$app])) return false;
        $secret = $this->client_config[$app];
        return $this->make($url,$app,$secret,$data);
	}

	public function make($url,$app,$secret,$data)
	{
		ksort($data);
		$params = http_build_query($data);
		return md5($app.$params . $secret.$url);
	}

}