<?php

namespace  Omid\LaraveMoblieLogin\http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestMobileNumber  extends FormRequest
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
        return ["mobile"=>"required|max:10|regex:/^9[0-9]{9}$/i"];
    }

    public function messages()
    {
        return ["mobile.regex"=>"mobile format is wrong"];
    }
}
