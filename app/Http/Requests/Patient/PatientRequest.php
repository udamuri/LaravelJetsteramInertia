<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
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
            'name' => [
                'required',
                'max:200',
            ],
            'address' => [
                'required',
                'max:255',
            ],
			'rtrw' => [
                'required',
                'max:100',
            ],
			'phone' => [
                'required',
                'max:20',
            ],
			'birth_date' => [
                'required',
                'date_format:Y-m-d',
            ],
			'gender' => [
                'required',
                'in:L,P',
            ],
			'village_id' => [
                'required',
                'exists:villages,id',
            ],
        ];

		if ($this->getMethod() == 'PUT') {
            //$rules['name'] = [
            //    'required',
            //    'numeric',
			//	'max:255',
            //    Rule::unique('accounts')->ignore($this->room),
            //];
        }

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
            'name' => 'Nama Pasien',
            'address' => 'Alamat',
            'rtrw' => 'RT/RW',
            'phone' => 'No Telepon',
            'birth_date' => 'Tanggal Lahir',
            'gender' => 'Jenis Kelamin',
            'village_id' => 'Kelurahan',
        ];

        return $attributes;
    }
}
