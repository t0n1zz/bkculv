<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AdminTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 1) as $index)
		{
			Admin::create([
                'username' => 't0n1zz',
                'name' => 'Tony',
                'password' => Hash::make('admin')
			]);
		}
	}

}