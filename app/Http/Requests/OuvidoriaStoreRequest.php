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
        $this->sanitize();

        return [
            'nome' => ['string','nullable'],
            'descricao' => ['string', 'required'],
            'categoria_id' => ['required',' integer'],
            'demandante_id' => ['required','integer'],
            'campus_id' => ['required','integer']
        ];
    }

    public function sanitize()
    {
        $data = $this->post();

        $data['contato'] = ($data['tipo_contato_id'] == 2) ? str_replace(['-', '(', ')', ' '], "", $data['contato']) : $data['contato'];

        $this->replace($data);
    }
}
