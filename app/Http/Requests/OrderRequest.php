<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome_cliente' => 'required|min3|alpha',
                'rua_cliente' => 'required|min:5|alpha',
                'numero_cliente' => 'required|integer',
                'bairro_cliente' => 'required|min:3|alpha',
                'cidade_cliente' => 'required|min:3|alpha',
                'contato_cliente' => 'integer',
                'descricao_servico' => $request->descricao_servico,
                'id_service' => $request->id_service,
                'data_ordem' => $request->data_ordem,
                'hora_ordem' => $request->hora_ordem,
                'type_id' => $request->type ? $request->type : 1,
                'situation_id' => $request->situation ? $request->situation : 3,
                'recurrence' => $request->recurrence ? $request->recurrence : 1,
                'months' => $request->months ? $request->months : 0,
                'insurance' => $request->insurance,
                'insurance_cod' => $request->insurance_cod,
                'duration' => $request->duration ? $request->duration : 4
        ];
    }
}
