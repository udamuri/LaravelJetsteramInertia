<?php

namespace App\Http\Requests\Village;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VillageRequest extends FormRequest
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
     * Get the validation rules that apply to the request.s
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'kelurahan' => [
                'required',
                'max:200',
            ],
            'kecamatan' => [
                'required',
                'max:200',
            ],
			'kota' => [
                'required',
                'max:200',
            ],
        ];

        return $rules;
    }

    /**
    * Get custom attributes for validator errors.
    *
    * @return array
    */
    public function attributes()
    {
        $attributes = [
            'kelurahan' => 'Kelurahan',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
        ];

        return $attributes;
    }
}
