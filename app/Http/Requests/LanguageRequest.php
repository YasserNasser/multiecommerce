<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
            'name' =>'required|string|max:100',
            'abbr' =>'required|string|max:10',
            //'active' =>'required|in:0,1',
            'direction' =>'required|in:rtl,ltr',

        ];
    }
    public function messages(){
        return [
            'required' =>'هذا الحقل مطلوب',
            'name.string' =>'اسم اللغة يجب ان يكون أحرف',
            'abbr.string' =>'إختصار اللغة يجب ان يكون أحرف',
            'name.max' =>'اسم اللغة يجب ان يكون اقل من 100 حرف',
            'abbr.max' =>'إختصار اللغة يجب ان يكون اقل من 10 حرف',
            'in' =>'القيم المدخلة غير صحيحة',

        ];
    }
}
