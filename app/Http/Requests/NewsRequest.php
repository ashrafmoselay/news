<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewsRequest extends Request
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
       $rule = [
                'title'=>'required|max:255',
                'short_desc'=>'required',
                'content'=>'required',
                'image'=>'image|max:1024'
            ];
        return $rule;
    }
}
