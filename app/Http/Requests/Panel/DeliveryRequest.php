<?php

namespace App\Http\Requests\Panel;

use App\Http\Requests\Request;

class DeliveryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required',
            'amount' => 'required|numeric',
            'sender' => 'required',
            'receiver' => 'required',
            'company' => 'required',
        ];
    }
}