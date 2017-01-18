<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Cache as Cache;

class ContactRequest extends Request
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
        $rules = [
            'name'    => 'required|max:200',
            'email'   => 'required|email',
            'content' => 'required|max: 1000',

        ];

        if (isset(Cache::get('settings')['recaptcha_enabled'])) {
            $recaptchaRule = ['recaptcha_response_field' => 'required|recaptcha'];
            $rules         = array_merge($rules, $recaptchaRule);
        }

        return $rules;
    }
}
