<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class WithdrawRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'withdraw_amount' => 'required|numeric|min:1',
        ];
    }

   /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'withdraw_amount.required' => trans('validation.withdraw_amount_required'),
        ];
    }
}
