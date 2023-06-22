<?php

namespace Datumsquare\SocialShare\Service\Connectors\Facebook;

use Exception;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

class FacebookConnector
{
    private $api;

    public function __construct()
    {
        $model = config('socialshare.model');
        $token = (new $model)->where('user_id', auth()->id())->where(config('socialshare.provider_column'), 'facebook')->first()?->toArray();

        if (!$token)
            throw new Exception('No auth token found against this user.', 404);
        
        $fb = new Facebook;
        $fb->setDefaultAccessToken($token[config('socialshare.token_column')]);
        $this->api = $fb;

    }

    public function retrieveUserProfile(){
        try {
        $response = $this->api->get('/me');
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
        }

        $me = $response->getGraphUser();
        dd($me);
    }


    public function post($data) {
        $data = [
            'message' => $data['message'],
            'source' => $this->api->fileToUpload($data['url']),
        ];

        try {
            $page = $this->api->get('me/accounts');
            $pageResponse = $page->getGraphEdge();
            if ($pageResponse) {
                $pageToken = $pageResponse[0]['access_token'] ?? null;
                $response = $this->api->post('/me/photos', $data, $pageToken);
            }
        } catch(FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
        exit;
        } catch(FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
        }

        $graphNode = $response->getGraphNode();
    }
    
    
}