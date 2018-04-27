<?php namespace app;
// 业务代码，测试微信SDK功能
use wechat\Wx;

class Entry {
	protected $wx;
	public function __construct() {
		$config = [
			'token' => 'wsweb'
		];
		$this->wx = new Wx($config);
		$this->wx->valid();
	}
	public function handler () {
		// echo 'handler';
		// (new Wx())->show();
	}
}