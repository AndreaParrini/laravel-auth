<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTypeRequest extends FormRequest
{

    protected $errorBag = 'nameType';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|min:5|max:50',
            'hiddenField' => 'exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute is required',
            'name.min' => 'The :attribute is too short, must be have 5 characters.',

        ];
    }
}
