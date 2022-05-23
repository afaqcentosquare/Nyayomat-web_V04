<?php

namespace App\Http\Requests\Validations;

use Auth;
use App\Cart;
use App\Http\Requests\Request;

class CheckoutAllCartRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $cart = Cart::where('ip_address', $this->ip())->first();

        return crosscheckCartOwnership($this, $cart);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        if (!Auth::guard('customer')->check()) {
            if ($this->has('create-account')) {
                $rules['email'] = 'required|email|max:255|unique:customers';
                $rules['password'] = 'nullable|required_with:create-account|confirmed|min:6';
            } else {
                $rules['email'] = 'required|email|max:255';
            }
        }

        if ('saved_card' != $this->payment_method) {
            $rules['payment_method'] = ['required', 'exists:payment_methods,id,enabled,1'];
        }

        return $rules;
    }
}
