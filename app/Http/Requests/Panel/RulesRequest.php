<?php

namespace App\Http\Requests\Panel;

use App\Http\Requests\Request;

class RulesRequest extends Request
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
            'order' => 'required|numeric',
            'item' => 'min:2|max:20',
            'content' => 'required|min:2',
        ];
    }
}