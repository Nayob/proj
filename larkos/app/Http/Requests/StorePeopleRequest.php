<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StorePeopleRequest extends FormRequest
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
            'name' => 'required|string|max:10',
            'email' => 'required|email',
            'phone' => '',
        ];
    }

    public function withValidator($validator)
    {
            $validator->after(function ($validator) {
                if ($this->hasFile('avatar')) {
                    // Perform additional validation checks here
                    $file = $this->file('avatar');
                    $filesize = $file->getSize();

                    // Example: Validate if birthdate is in the past
                    if ($filesize > 26214400) {
                        $validator->errors()->add('avatar', 'File size bigger than 25M');
                    }
                } else {
                    $validator->errors()->add('avatar', 'You definetly need to chose the fuckin file!');
                }
            });
        
    }
}
