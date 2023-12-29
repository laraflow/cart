<?php

namespace Laraflow\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * // Crud Service Method Point Do not Remove //
 *
 * @see \Laraflow\Cart\Cart
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Laraflow\Cart\Cart::class;
    }
}
