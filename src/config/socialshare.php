<?php

use App\Models\General\OAuthToken;

return [
    'model' => OAuthToken::class,
    'token_column' => 'access_token',
    'provider_column' => 'provider' 
];