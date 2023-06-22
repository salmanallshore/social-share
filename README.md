# Social Share

Create posts for various social platforms such as Twitter and Facebook. This package offers a user-friendly facade that allows you to effortlessly generate new posts without the need for complex coding.

## Package Configuration

To run this project, you will need to add the following environment variables to your `.env` file and configuration in `app/services.php`

```
'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID', ''),
        'client_secret' => env('FACEBOOK_APP_SECRET', ''),
        'redirect' => env('FACEBOOK_REDIRECT_URI', config('app.url') . '/auth/facebook/callback'),
        'default_graph_version' => 'v17.0',
        'scopes' => [
            'email',
            'instagram_content_publish',
            'user_posts',
            'pages_manage_posts',
        ]
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID', ''),
        'client_secret' => env('TWITTER_CLIENT_SECRET', ''),
        'redirect' => env('TWITTER_REDIRECT_URL', config('app.url') . '/auth/twitter/callback'),
        'api_url' => 'https://api.twitter.com/2',
        'oauth' => 2,
        'scopes' => [
            'tweet.write',
            'tweet.read',
            'users.read'
        ]
    ],
```

**Publish Vendor File:**

`php artisan vendor:publish --provider=Datumsquare\SocialShare\SocialShareProvider`

You can change the model and column names for access token and provider.

**Environment Variables:**

`FACEBOOK_APP_ID`
`FACEBOOK_APP_SECRET`

`TWITTER_CLIENT_ID`
`TWITTER_CLIENT_SECRET`
`TWITTER_REDIRECT_URL`

**Register Service Provider and Facade:**

Register package service provider and facade in `config/app.php` file:

Provider: `\Datumsquare\SocialShare\SocialShareProvider::class`

Alias/Facade: `'SocialShare' => \Datumsquare\SocialShare\SocialShare::class`

## Usage/Examples

```php
SocialShare::post('twitter', ['message' => 'New Tweet']);

SocialShare::post('facebook', ['message' => 'New post', 'url' => Object]);
```

## Features

-   Facebook (Text, Image)
-   Twitter (Text)

## Badges

Add badges from somewhere like: [shields.io](https://shields.io/)

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)
[![AGPL License](https://img.shields.io/badge/license-AGPL-blue.svg)](http://www.gnu.org/licenses/agpl-3.0)

## Authors

-   [@salman](https://github.com/salmanallshore)

## Feedback

If you have any feedback, please reach out to us at salman.h@allshorestaffing.com
