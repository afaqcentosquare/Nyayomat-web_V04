<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\Request;

class CreateCityRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Request::merge(['user_id' => Request::user()->id]); //Set user_id

        return [
           'name' => 'required|unique:in_cities',
        ];
    }
}
