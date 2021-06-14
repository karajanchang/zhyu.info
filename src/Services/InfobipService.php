<?php

namespace ZhyuInfo\Helpers;

use ZhyuInfo\Sms\Client;

class InfobipService {
	public function sms(){
		return app()->make(Client::class);
	}
}