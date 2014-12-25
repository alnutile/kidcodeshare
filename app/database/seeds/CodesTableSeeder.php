<?php

use Faker\Factory as Faker;

class CodesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

        $gists = [
            'b9a337e8d320a847744d',
            '74c61d58d427aeba519a'
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