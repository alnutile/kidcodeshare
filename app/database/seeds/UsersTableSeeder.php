<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 12/20/14
 * Time: 5:38 PM
 */

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $user = new User;
        $user->username = 'alfrednutile';
        $user->email = 'me@alfrednutile.info';
        $user->password = 'foobar';
        $user->password_confirmation = 'foobar';
        $user->confirmation_code = md5(uniqid(mt_rand(), true));
        $user->confirmed = 1;

        if(! $user->save()) {
            Log::info('Unable to create user '.$user->username, (array)$user->errors());
        } else {
            Log::info('Created user "'.$user->username.'" <'.$user->email.'>');
        }
    }

} 