<?php
namespace ZhyuInfo\Facades;

use Illuminate\Support\Facades\Facade;


class InfobipFacade extends Facade {
    protected static function getFacadeAccessor() { return 'InfobipSms'; }
}