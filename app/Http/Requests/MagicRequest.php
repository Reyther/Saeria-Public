<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Magic;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MagicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             Magic::COL_NAME => 'required|min:3|max:255',
             Magic::COL_DESC => 'required|min:3|max:3000',
             Magic::COL_CIRCLE => ['required',Rule::in(['Élémentaire','Divin','Secondaire','Énergétique'])],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
