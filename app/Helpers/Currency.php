<?php

namespace App\Helpers;

// use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Session;
use NumberFormatter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class Currency
{
    // عملنا الفانكشن دي علشان لو بعتنا اكثر من حاجه يقبل عادي
    public function __invoke(...$params)
    {
        return static::format(...$params);
    }

    // public static function format($amount, $currency = null)
    // {
// هيلبر فانكشن موجوده في البي اتش بي بنقوله خد اللغه من الكونفيج
    //     $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        
    //     if ($currency === null) {
    //         // ديفولت علشان لو مفيش عمله بس لازم في فايل الكونفيج تعرف الكارانسي
    //         // و لازم في نفس الفايل تعرف الايلياس علشان تستدعي الميثود في الفرونت من غير ما تكتب النايم اسبايس بتاعها
    //         $currency = config('app.currency','USD');
    //     }

    //     return $formatter->formatCurrency($amount, $currency);
    // }
    public static function format($amount, $currency = null)
    {
        $baseCurrency = config('app.currency', 'USD');

        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        
        if ($currency === null) {
            $currency = Session::get('currency_code', $baseCurrency);
        }

        if ($currency != $baseCurrency) {
            $rate = Cache::get('currency_rate_' . $currency, 1);
            $amount = $amount * $rate;
        }

        return $formatter->formatCurrency($amount, $currency);
    }
}