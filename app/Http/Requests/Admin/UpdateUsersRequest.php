<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersRequest extends FormRequest
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
            
            'name' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'phone' => 'required|unique:users,phone,'.$this->route('user'),
            'salary' => 'required',
            'role_id' => 'required',
            'department_id' => 'required',
            'mac_adress' => 'required|unique:users,mac_adress,'.$this->route('user'),
        ];
    }
}
