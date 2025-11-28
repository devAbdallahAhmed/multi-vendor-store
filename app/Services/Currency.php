<?php


namespace App\Services;
use Illuminate\Support\Facades\Http;

class Currency {


    private $apiKey;

    protected $baseUrl = 'https://free.currconv.com/api/v7/';

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function convert (float $amount, string $fromCurrency, string $toCurrency) {

        Http::baseUrl($this->baseUrl)

        ->withHeader('content', 'application/json',
            'authorization', 'Bearer ' . $this->apiKey
     );

    }
}
