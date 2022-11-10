<?php


namespace App\Http\Requests;

use Auth;

use Illuminate\Foundation\Http\FormRequest;

class LinkTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required',
            'typename'  => 'required',
            'icon'      => 'required',
            'params'    => 'json|nullable'
        ];
    }
}
