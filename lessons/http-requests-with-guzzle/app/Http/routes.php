<?php

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

$this->get('github/users/{username}', function ($username) {
    $client = new Client(['base_uri' => 'https://api.github.com/']);

    $response = $client->get("users/$username");

    $responseJson = json_decode($response->getBody(), true);

    return $responseJson;
});

$this->get('twitter/search/{q}', function ($q) {
    $stack = HandlerStack::create();

    $middleware = new Oauth1([
        'consumer_key'    => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET'),
        'token'           => env('TWITTER_TOKEN'),
        'token_secret'    => env('TWITTER_TOKEN_SECRET'),
    ]);
    $stack->push($middleware);

    $client = new Client([
        'base_uri' => 'https://api.twitter.com/1.1/',
        'handler'  => $stack,
        'auth'     => 'oauth'
    ]);

    $response = $client->get("search/tweets.json?q=$q");

    $responseJson = json_decode($response->getBody(), true);

    $statuses =  array_only($responseJson, 'statuses');

    return $statuses;
});
