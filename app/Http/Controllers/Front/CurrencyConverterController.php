<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'currency_code' => 'required|string|size:3',
        ]);

        $baseCurrencyCode = config('app.currency');
        $currencyCode = $request->input('currency_code');

        $cacheKey = 'currency_rate_' . $currencyCode;
// هات القيمه الي في الكاش لو مش موجوده خليعا صفر
        $rate = Cache::get($cacheKey, 0);
// لو مش موجوده
        if (!$rate) {
            $converter = app('currency.converter');
            $rate = $converter->convert($baseCurrencyCode, $currencyCode);

            Cache::put($cacheKey, $rate, now()->addMinutes(60));
        }

        Session::put('currency_code', $currencyCode);

        return redirect()->back();

    }

}
