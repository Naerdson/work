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
            'nome' => 'string|nullable',
            'tipo_contato_id' => 'integer|required|exists:tipos_contatos,id',
            'contato' => 'required',
            'descricao' => 'string|required',
            'categoria_id' => 'required|integer|exists:ouvidorias_categorias,id',
            'demandante_id' => 'required|integer|exists:ouvidorias_demandantes,id',
            'campus_id' => 'required|integer|exists:campus,id',
            'causa_id' => 'required|integer|exists:causas,id',
            'setor_id' => 'required|integer|exists:setores,id'
        ];

        $this->sanitize();
    }

    public function sanitize()
    {
        $data = $this->post();

        $data['contato'] = ($data['tipo_contato_id'] == 2) ? str_replace(['-', '(', ')', ' '], "", $data['contato']) : $data['contato'];

        $this->replace($data);
    }
}
