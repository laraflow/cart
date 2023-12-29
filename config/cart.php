<?php

// config for Laraflow/Cart
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | This setting will publish the cart communication route to the system.
    */
    'api_enabled' => env('CART_API_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cart Driver
    |--------------------------------------------------------------------------
    | Cart content will be store and retrieved using this driver
    | available drivers are session and database
    */
    'driver' => 'session',

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    | When displaying the prices which currency symbols and format will be used
    | @see https://www.iban.com/currency-codes for available options
    */
    'currency' => 'USD',

    /*
    |--------------------------------------------------------------------------
    | Currency Symbol
    |--------------------------------------------------------------------------
    | When displaying the prices do system will add currency symbol
    | if available or not.
    */
    'show_currency_symbol' => false,

    /*
    |--------------------------------------------------------------------------
    | Cart Item Add method parameters
    |--------------------------------------------------------------------------
    | This array will be converted to parameters of Cart::add() method
    | if key has a value that will be considered as default value else the
    | field will be considered as a required parameter.
    |
    | Example: Cart::add($name, $quantity = 1, $price, $weight = null, $options = []);
    */
    'cart_item_attributes' => [
        'name',
        'quantity' => 1,
        'price',
        'weight' => null,
        'options' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cart Item Unit Price Field
    |--------------------------------------------------------------------------
    | Which field from cart item attributes will be considered for unit price
    | calculation.
    | Note: This field will be considered must available attributes
    */
    'price_field' => 'price',

    /*
    |--------------------------------------------------------------------------
    | Cart Item Quantity Field
    |--------------------------------------------------------------------------
    | Which field from cart item attributes will be considered quantity identifier
    | Note: This field will be considered must available attributes
    */
    'quantity_field' => 'quantity',

    /*
    |--------------------------------------------------------------------------
    | Cart Item Discount Field
    |--------------------------------------------------------------------------
    | Which field from cart item attributes will be considered discount identifier
    | both "flat" and "percent" is allowed
    | Example: 100.00 or 10%
    | Note: This field will be considered must available attributes
    */
    'discount_field' => 'discount',

    /*
    |--------------------------------------------------------------------------
    | Multiple Items Wrapper Field
    |--------------------------------------------------------------------------
    | While inserting bulk items to cart
    |
    | Example: Cart::addMany($items);
    */
    'collection_field' => 'items',
];
