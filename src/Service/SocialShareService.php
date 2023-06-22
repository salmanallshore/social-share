<?php

namespace Datumsquare\SocialShare\Service;

use Datumsquare\SocialShare\Service\Connectors\Twitter\TwitterConnector;
use Datumsquare\SocialShare\Service\Connectors\Facebook\FacebookConnector;


class SocialShareService
{
    public function post (string $provider, array $parameters) {
        return match($provider) {
            'twitter' => (new TwitterConnector)->tweet($parameters),
            'facebook' => (new FacebookConnector)->post($parameters)
        };
    }
}
