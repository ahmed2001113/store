<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    // ده بنعرفه في فايل الانف و الكونفيج-سيرفيس
    private $apiKey;
// ده لينك انا جيبته من موقع
    protected $baseUrl = 'https://free.currconv.com/api/v7';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
// فانكشن علشان نبعت للموقع بيانات الابي اي الي احنا عايزينه
    public function convert(string $from, string $to, float $amount = 1): float
    {
        $q = "{$from}_{$to}";
        $response = Http::baseUrl($this->baseUrl)
            ->get('/convert', [
                'q' => $q,
                'compact' => 'y',
                'apiKey' => $this->apiKey,
            ]);

        $result = $response->json();
        
        return $result[$q]['val'] * $amount;
    }
}