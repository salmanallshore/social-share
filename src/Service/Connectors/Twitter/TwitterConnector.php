<?php

namespace Datumsquare\SocialShare\Service\Connectors\Twitter;

use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;


final class TwitterConnector
{
    private const CONFIG = 'services.twitter.api_url';

    protected string $token;

    protected function getAuthToken () {
        $model = config('socialshare.model');
        $token = (new $model)->where('user_id', auth()->id())->where(config('socialshare.provider_column'), 'twitter')->first()?->toArray();

        if (!$token)
            throw new Exception('No auth token found against this user.', 404);
        
        $this->token = $token[config('socialshare.token_column')];    
    }

    private function withBaseUrl(): PendingRequest
    {
        $this->getAuthToken();

        return Http::baseUrl(
            url: config(self::CONFIG),
        )
        ->timeout(15)
        ->withToken($this->token);
    }

    private function get(string $url): Response
    {
        return $this->withBaseUrl()
            ->get($url);
    }

    private function post(string $url, mixed $data): Response
    {
        return $this->withBaseUrl()
            ->post($url, $data);
    }
    
    public function tweet($data) {
        $data = [
            'text' => $data['message']
        ];
        
        $response = $this->post("/tweets", $data);

        if ($response->successful()) {
            return response()->json([
                'response' => $response->json()
            ]);
        }

    }
}
