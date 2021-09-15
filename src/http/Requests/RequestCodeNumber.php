<?php

namespace  Omid\LaraveMoblieLogin\http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCodeNumber  extends FormRequest
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
            "code"=>"required|max:10|string",
            "mobile"=>"required|max:10|regex:/^9[0-9]{9}$/i"
        ];
    }
    public function messages()
    {
        return ["mobile.regex"=>"mobile format in wrong"];
    }
}
