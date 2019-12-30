<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addcat extends FormRequest
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
            "category"=>"required|alpha|min:2|max:50|unique:categories",
			"image"=>"required",
        ];
    }
	
	
	
	public function messages()
	{
		return [
			"category.required" => "Enter Category Name",
			"category.alpha" => "Only Alpha Allowed",
			"category.unique"=>"Category Already Exist",
			"image.required"=>"Please Choose File",
			];
	}
	
	
	
	
	
}
