<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionsRequest extends FormRequest
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
            'name_id' => 'required',
            'time_date' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'id_number_id' => 'required',
            'mac_adress' => 'required',
            'type' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif',
        ];
    }
}
