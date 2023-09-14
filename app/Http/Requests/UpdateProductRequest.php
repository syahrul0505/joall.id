<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->user()->roles == "admin") {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($_FILES['photos']['name'] != '') {
            return [
                'name' =>'required',
                'description' =>'required',
                'price' =>'required',
                'stock' =>'required',
                'photos' => 'image|file|max:1024',
            ];
        }else {
            return [
                'name' =>'required',
                'description' =>'required',
                'price' =>'required',
               'stock' =>'required',
            ];
        }
    }
}