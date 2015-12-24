<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DhcpRequest extends Request
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
            'macs.*' => 'required|regex:/^([0-9a-fA-F]{2}[:\-]){5}[0-9a-fA-F]{2}$/',
            'ip' => 'ip',
            'added_by' => 'required|email',
            'owner_email' => 'required|email',
        ];
    }
}
