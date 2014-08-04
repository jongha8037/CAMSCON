<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('GroupTableSeeder');
		$this->command->info('Group table seeded!');
	}

}

class GroupTableSeeder extends Seeder {

	public function run() {
		DB::table('groups')->delete();
		DB::table('groups')->truncate();

		Group::create(array('name'=>'Campus Style Icons'));
		Group::create(array('name'=>'Active Photographers'));
		Group::create(array('name'=>'Retired Photographers'));
		Group::create(array('name'=>'Bloggers'));
		Group::create(array('name'=>'Staff'));
		Group::create(array('name'=>'Managers'));
		Group::create(array('name'=>'Super Users'));
		Group::create(array('name'=>'Blacklist'));
	}

}