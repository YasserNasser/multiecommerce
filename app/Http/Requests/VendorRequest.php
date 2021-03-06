<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'category_id' => 'required_without:id|exists:main_categories,id',
            'name' => 'required_without:id|string|max:145',
            'mobile' => 'required_without:id|max:100|unique:vendors,mobile,'.$this->id,
            'email' => 'required_without:id|email|unique:vendors,email,'.$this->id,
            'address' => 'required_without:id|string|max:350',
            'password' => 'required_without:id',
        ];
    }

    public function messages(){
        return [

            'required' => 'هذا الحقل مطلوب',
            'required_without' => 'هذا الحقل مطلوب',
            'photo.required_without' => 'الصورة مطلوبة',
            'max' => 'هذا الحقل طويل',
            'address.string' => 'العنوان يجب ان يكون حروف او حروف و أرقام',
            'name.string' => '  الاسم يجب ان يكون حروف او حروف و أرقام',
            'email.email' => 'الرجاء ادخال ايميل صحيح',
            'category_id.exists' => 'القسم غير موجود',
            'mobile.unique' => 'هذا الرقم تم استخدامه من قبل',
            'email.unique' => 'هذا الايميل تم استخدامه من قبل',
            'password.min' => 'كلمة السر يجب ان تكون أكثر من 8 أحروف وأرقام',
        ];
    }
}
