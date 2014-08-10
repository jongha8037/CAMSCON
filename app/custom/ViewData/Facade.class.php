<?php
namespace CafeCoder\Laravel\ViewData;
use Illuminate\Support\Facades\Facade;

class ViewData extends Facade {

    protected static function getFacadeAccessor() { return 'custom_viewdata'; }

}
?>