<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ExternalApiAuth{

    public function getToken()
    {
        return Cache::remember('api_token',3500, function() {
            $response = Http::post(config('external.external_api_url') . '/auth', [
                "email" => config('external.external_api_email'),
                "password" => config('external.external_api_pass')
            ]);

            $data = $response->json();

            $expiresIn = $data['expires_in'] - 180;

            Cache::put('api_token', $data['access_token'], $expiresIn);

            return $data['access_token'];

        });

       
    }

    public function getMedicine()
    {
        $token = Cache::get('api_token') ?? $this->getToken();

        $response = Http::withToken($token)->get(config('external.external_api_url') . '/medicines');

         return $response->json();
    }

    public function getMedicinePrice(string $medicine_id)
    {

        $token = Cache::get('api_token') ?? $this->getToken();

        $response = Http::withToken($token)->get(config('external.external_api_url') . "/medicines/" . $medicine_id . "/prices");

        return $response->json();
    }
}