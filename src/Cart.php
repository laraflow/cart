<?php

namespace Laraflow\Cart;

use BadMethodCallException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Validation\ValidationException;
use Laraflow\Cart\Traits\Componentable;

class Cart
{
    use Macroable, Componentable {
        Macroable::__call as macroCall;
        Componentable::__call as componentCall;
    }

    public function __construct()
    {

    }

    /**
     * Return all configured rules for cart item storing
     * @return array
     */
    public static function validationRules(): array
    {
        $multiple_item_wrapper = config('cart.collection_field', 'items');

        $rules = [
            config('cart.price_field', 'price') => ['required', 'numeric', 'min:0'],
            config('cart.quantity_field', 'quantity') => ['required', 'numeric', 'min:0'],
            config('cart.discount_field', 'discount') => ['nullable', 'numeric', 'min:0'],
            $multiple_item_wrapper => 'array|nullable'
        ];

        $reserved_attributes = array_keys($rules);

        foreach (config('cart.cart_item_attributes') as $key => $attribute) {

            if (is_int($key)) {
                if (!in_array($attribute, $reserved_attributes)) {
                    $rules[$attribute][] = ['required'];
                }
            } else {
                if (!in_array($key, $reserved_attributes)) {
                    $rules[$key][] = ['required'];
                }
            }
        }

        //Multi Items Rules
        foreach ($rules as $field => $rule) {
            $rules["{$multiple_item_wrapper}.*.{$field}"] = $rules;
        }

        return $rules;
    }

    /**
     * Validate the inputs from plain array
     *
     * @throws ValidationException
     */
    public static function validate(array $inputs): bool
    {
        $validator = Validator::make($inputs, static::validationRules());

        if ($validator->invalid()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return true;
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        if (static::hasComponent($method)) {
            return $this->componentCall($method, $parameters);
        }

        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

        throw new BadMethodCallException("Method {$method} does not exist.");
    }
}
