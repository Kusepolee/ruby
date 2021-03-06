<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MemberStoreRequest extends Request
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
        return [
                'name'       => 'required|max:16',
                'department' => 'required|numeric',
                'position'   => 'required|numeric',
                'mobile'     => 'required|numeric|unique:members',
                'gender'     => 'required|numeric',
                'email'      => 'email',
                'weixinid'   => 'max:32|min:3',
                'qq'         => 'numeric|min:5',
                //'password'   => 'required|max:32|min:8|confirmed',
                'content'    => 'max:200|min:2',
        ];
    }
}
