<?php

namespace CodeShare\Providers;

use Github\Client;
use Illuminate\Support\ServiceProvider;

class GitProvider extends ServiceProvider {


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CodeShare\GitProviderInterface', function($app){
           $client = new Client();
           $user = getenv('git_user');
           $token = getenv('git_token');
           $client->authenticate($user, $token, Client::AUTH_HTTP_PASSWORD);
           return $client;
        });
    }
}