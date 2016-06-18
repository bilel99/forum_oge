<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class QuestionRequest extends Request
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
            'id_rubrique'   => 'required',
            'nom'      => 'required',
            'description'   => 'required'
        ];
    }

    /**
     * Custom messages error
     */
    public function messages(){
        return[
            'id_rubrique.required'  => Lang::get('global.champRequis'),
            'nom.required'     => Lang::get('global.champRequis'),
            'description.required'  => Lang::get('global.champRequis')
        ];
    }
}
