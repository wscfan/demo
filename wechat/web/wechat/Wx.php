<?php namespace wechat;
class Wx {
	protected $config = [];
	public function __construct(array $config) {
		$this->config = $config;
	}
	public function valid() {
	    $signature = $_GET["signature"];
	    $timestamp = $_GET["timestamp"];
	    $nonce = $_GET["nonce"];  
	    $token = this->config['token'];
	    $tmpArr = array($token, $timestamp, $nonce);
	    sort($tmpArr);
	    $tmpStr = implode( $tmpArr );
	    $tmpStr = sha1( $tmpStr );
	    
	    if( $tmpStr == $signature ){
	      echo $_GET["echostr"];
	    }
	}
}