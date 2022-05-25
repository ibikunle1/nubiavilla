<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => ['required', 'max:50', 'string'],            
            'description' => ['nullable', 'string'],
            'department'=> ['required','string'],
            'location'=> ['required', 'string'],            
            'profile_picture' => ['nullable', 'file', 'max:500', 'mimes:jpeg,JPG,jpg,png,PNG'],            
        ];
    }
    public function messages()
    {
        return[
        'name.required'=> 'Kindly provide your name',                                 
        'profile_picture.max'=> 'The maximum size of image allowed  is 500KB',
        'profile_picture.mimes'=> 'Kindly upload a valid image in either JPG, PNG or JPEG format',     
        'department.required'=> 'Kindly provide your department',
        'location.required'=> 'Kindly provide your location',        
        ];
    }
}
