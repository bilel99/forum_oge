<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Lang;

class ReponseRequest extends Request
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
            'id_question_forum' => 'required',
            'reponse'   => 'required'
        ];
    }

    /**
     * Custom messages error
     */
    public function messages(){
        return[
            'id_question_forum' => Lang::get('global.champRequis'),
            'reponse.required'  => Lang::get('global.champRequis')
        ];
    }
}
