<?php

namespace Laraflow\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laraflow\Cart\Facades\Cart;

class AddCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return Cart::validationRules();
    }
}
