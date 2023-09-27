<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|min:5',
            'link' => 'required|string|max:255|min:5',
        ];
    }

    public function messages()
    {
        $messages = [
            'required' => 'Bạn chưa điền vào đây'
        ];
        return [
            'name.required' => $messages['required'],
            'name.min' => 'Nhập ít nhất :min ký tự',
            'name.string' => 'Tên phải là chuỗi chỉ chứa các ký tự chữ cái và số',
            'name.max' => 'Nhập ít nhất :max ký tự',

            'link.required' => $messages['required'],
            'link.min' => 'Nhập ít nhất :min ký tự',
            'link.string' => 'Tên phải là chuỗi chỉ chứa các ký tự chữ cái và số',
            'link.max' => 'Nhập ít nhất :max ký tự',


        ];
    }
}
