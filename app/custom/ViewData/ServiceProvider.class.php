<?php
namespace CafeCoder\Laravel\ViewData;
use Illuminate\Support\ServiceProvider;

class ViewDataServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('custom_viewdata', function() {
			return new ViewDataClass();
		});
	}

}
?>