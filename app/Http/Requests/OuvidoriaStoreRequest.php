<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OuvidoriaStoreRequest extends FormRequest
{

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
            'nome' => 'string|required',
            'contato' => 'email|required',
            'descricao' => 'string|required',
            'categoria_id' => 'required|integer',
            'demandante_id' => 'required|integer',
            'campus_id' => 'required|integer'
        ];
    }
}
