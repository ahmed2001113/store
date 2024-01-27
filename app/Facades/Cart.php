<?php

namespace App\Facades;

use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */// لازم اسم الفانكشن يكون كده و بتكتب اسم الريبوستري
    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
}