<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'              => 'required|unique:users,username',
            'name'                  => 'required',
            'email'                 => 'required|email',
            'password'              => 'required',
            'password_confirm'      => 'required|same:password',
            'department_id'         => 'required',
            'status_id'             => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            '*.required'            => ':attribute không được để trống',
            'username.unique'       => 'Tên đăng nhập đã tồn tại',
            'email.email'           => 'Email không đúng định dạng',
            'password_confirm.same' => 'Mật khẩu nhập lại không khớp',
        ];
    }
    
}
