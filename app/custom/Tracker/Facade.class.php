<?php
namespace CafeCoder\Laravel\Tracker;
use Illuminate\Support\Facades\Facade;

class Tracker extends Facade {

    protected static function getFacadeAccessor() { return 'custom_tracker'; }

}
?>
