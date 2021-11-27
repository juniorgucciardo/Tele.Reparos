<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>IMPRESSÃO</title>

    <style type="text/css">
        
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
            padding: 2px;
        }
        .header{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: small;
            padding: 2px 0;
        }

        thead{
            margin: 2px 0;
        }

        .destak{
            background-color: lightblue;
            margin: 0.3rem 0;
            padding: 2px 0;
        }

        .gray {
            background-color: lightblue; 
        }
    </style>
</head>
<body>

  <table width="100%" class="header">
    <tr>

            <td width="15%">
                <img src="assets/brand.png" width="100px"/>
                <td width="80%">
                    <h2>Tele Reparos</h2>
                    Como podemos facilitar a sua vida? <br>

                    <b>CNPJ:</b> 37.629.639/0001-40<br>
                    Rua Duque de Caxias, 860 (Sala Comercial) - Centro<br>
                    Santo Ângelo/RS - CEP: 98803-412
                </td>
            </td>
        <td align="right" width="10%">
            <pre>
                telereparoscialtda@hotmail.com
                (55)99735-8040, (55)99701-4195
                @if ($attend->users->count() > 1)
                    Responsáveis:
                @else
                    Responsável:

                @endif
                @foreach ($attend->users as $user)
                    {{$user->name}}
                @endforeach
            </pre>
        </td>
    </tr>
  </table>

    <table width="100%">
        <thead>
                <th width="60%" class="destak">Ordem de serviço: {{$attend->id}}</th> 
                <th width="40%" class="destak">{{$attend->data_inicial->translatedFormat('l \, j \d\e F \- H:i') }}</th>
        </thead>
    </table>



    <table width="100%" border="1px">
        <thead style="background-color: lightblue;">
            <tr>
                <th colspan="4">
                    Informações do cliente
                </th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <th align="left">Nome</th>
                <td align="left">{{$attend->orders->nome_cliente}}</td>
            
                <th align="left">Endereço</th>
                <td align="left">{{$attend->orders->rua_cliente}}, {{$attend->orders->numero_cliente}} - {{$attend->orders->bairro_cliente}}</td>
            </tr>
            <tr>
                <th align="left">Cidade</th>
                <td align="left">{{$attend->orders->cidade_cliente}}</td>
         
                <th align="left">Contato</th>
                <td scope="row">{{$attend->orders->contato_cliente}}</td>
            </tr>
        </tbody>
    </table>


    <table width="100%" border="1px">
        <thead style="background-color: lightblue;">
            <tr>
                <th colspan="4">
                    Informações do serviço
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th align="left">Serviço</th>
                <td align="left">{{$attend->orders->service->service_title}}</td>

                <th align="left">Tipo</th>
                <td align="left">{{$attend->orders->type->type_title}}</td>

            </tr>

            <tr>
                
                <th align="left">recorrência de atendimento</th>
                <td align="left">Diário</td>

                <th align="left">Produtos e equipamentos</th>
                <td scope="row">Inclusos</td>


            </tr>
            <br>
        </tbody>
    </table>

    <table width="100%">
        <tbody>
            <tr>
                <th align="left" width="15%">Observações:</th>
                <td colspan="3" align="left">{{$attend->orders->descricao_servico}} {{$attend->description}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>Imagens</tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($attend->orders->img_contract as $img)
                    <td>
                        <img width="120px" src="storage/contract_img/{{$img->img_contract}}" alt="">
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <table width="100%">
        @foreach ($activities as $checklist)
        <thead style="background-color: lightblue;">
            <tr>
                <th colspan="4" align="left">
                    {{$checklist->title}}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($checklist->items as $item)
            <tr>
                <th scope="row" width="4%">( )</th>
                <th align="left" width="96%">{{$item->title}}</th>
            </tr>
            @endforeach
           @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th align="left">Avisos:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    -> Lembramos que o uso de EPI é obrigatório para a sua segurança e segurança de todos!
                </td>
            </tr>
            <tr>
                <td>
                    -> A lista anterior serve apenas como um guia para padronizar o nosso atendimento, É necessário visualizar sempre o que pode ser feito alem disto.
                </td>
            </tr>
            <tr>
                <td>
                    -> É de extrema importância respeitar os horários de inicio e fim das demandas! Caso seja necessário ultrapassar o horário previsto, entre em contato com a empresa.
                </td>
            </tr>
        </tbody>
    </table>


    <table width="100%" footer>
        <tbody>
            <tr style="background-color: lightblue;">
                <td align="center">Inicio do atendimento: <b>{{$attend->data_inicial->format('H:i')}}</b></td>
                <td align="center">Fim do atendimento: <b>{{$attend->data_final->format('H:i')}}</b></td>
            </tr>
            <tr style="margin:30px 0">
                <td align="center" style="padding: 30px 0">
                    <div>_____________________________</div>
                    <div>Assinatura do cliente</div>
                </td>
                <td align="center" style="padding: 30px 0">
                    <div>_____________________________</div>
                    <div>Assinatura do prestador</div>
                </td>
            </tr>
        </tbody>
    </table>
    
   



  
</body>
</html>