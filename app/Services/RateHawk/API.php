<?php

namespace App\Services\RateHawk;


use App\Services\RateHawk\Requests\Request;
use App\Services\RateHawk\Responses\Response;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;

class API
{
    public function __construct(
        private readonly Client $client
    ) {}

    public function send(Request $request): Response
    {
        try {
            $method = $request->getMethod()->value;
            $response = $this->client->$method(
                config('api.ratehawk.url') . $request->getEndpoint(),
                [
                    RequestOptions::AUTH => [
                        config('api.ratehawk.api_key'),
                        config('api.ratehawk.api_secret')
                    ],
                    RequestOptions::JSON => $request->getPayload(),
                    RequestOptions::HEADERS => array_merge(
                        $request->getHeaders(), [
                            'Content-Type: application/json',
                        ]
                    )
                ]
            );

            $json = json_decode((string)$response->getBody(), true);

            $response = $request->getResponseClass();
            $response->populate($json);

            return $response;
        } catch (ClientException $exception) {
            dd((string) $exception->getResponse()->getBody());
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
