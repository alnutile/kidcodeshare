<?php

use Faker\Factory as Faker;

class CodesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $gists = [
            '30252d71be6cdd01769e',
            'c95957d1c806f92804fd'
        ];
        $user = User::where('email', 'me@alfrednutile.info')->first();
		foreach(range(1, 10) as $index)
		{
			Code::create([
                'title' => $faker->sentences(1,3),
                'user_id' => $user->id,
                'gist_id' => $gists[rand(0,1)]
			]);
		}
	}

}