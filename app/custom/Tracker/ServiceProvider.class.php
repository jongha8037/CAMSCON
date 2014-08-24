<?php
namespace CafeCoder\Laravel\Tracker;
use Illuminate\Support\ServiceProvider;

class TrackerServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton('custom_tracker', function() {
			return new TrackerClass();
		});
	}

}
?>
