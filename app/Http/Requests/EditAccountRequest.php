<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAccountRequest extends FormRequest
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
            "name" => "string|min:6",
            "username" => "alpha_dash|min:3",
            "email" => "email|min:12",
            "password" => "string|min:5",
            "nomor_hp" => "numeric|min:10",
            "universitas" => "string|min:3"
        ];
    }
}
