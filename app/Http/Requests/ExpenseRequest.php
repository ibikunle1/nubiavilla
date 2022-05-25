<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'merchant' => ['required'],            
            'total' => ['required', 'numeric'],
            'date'=> ['required','string'],
            'comment'=> ['nullable', 'string'],            
            'receipt' => ['nullable', 'file', 'max:500', 'mimes:jpeg,JPG,jpg,png,PNG'],            
        ];
    }
    public function messages()
    {
        return[
        'merchant.required'=> 'Kindly select your merchant',                         
        'receipt.required'=> 'Receipt is required',
        'receipt.max'=> 'The maximum size of image allowed  is 500KB',
        'receipt.mimes'=> 'Kindly upload a valid image in either JPG, PNG or JPEG format',     
        'date.required'=> 'Kindly select date',
        'total.required'=> 'Kindly provide your total price',        
        'total.numeric'=> 'Only number are allowed',        
        ];
    }
}
