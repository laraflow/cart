<?php

namespace Laraflow\Cart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static array validationRules()
 * @method static bool validate(array $inputs)
 * @see \Laraflow\Cart\Cart
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'cart';
    }
}
