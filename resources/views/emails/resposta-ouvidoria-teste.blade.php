<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="margin:0; padding: 0;">
    <table border="0" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 0px 0 5px 0;">
                <img src="http://www.unifametro.edu.br/cvtt/wp-content/uploads/2019/07/logo-unifametro-01.png" style="max-width: 80%; display: block;" alt="Logo Unifametro">
                <hr>
            </td>
        </tr>
        <tr>
            <td  style="padding: 40px 30px 40px 30px;">
               <table cellpadding="0" cellspacing="0" width="100%">
                   <tr>
                        <td>
                            <p style="font-family: 'Open Sans', sans-serif;color: rgb(92, 86, 86);font-weight: 300; font-size: 21px;">Prezado(a), me chamo {{ $usuario->nome }}, estou entrando em contato para tratar a demanda aberta no dia {{ $ouvidoria->data2}}.</p>
                        </td>
                   </tr>
                   <tr>
                        <td>
                            <p style="font-family: 'Open Sans', sans-serif;color: rgb(92, 86, 86);font-weight: 300; font-size: 19px;">Número do protocolo: {{ $ouvidoria->protocolo }}</p>
                        </td>
                   </tr>
                   <tr>
                       <td style="padding-bottom:1%">
                           <p style="font-family: 'Open Sans', sans-serif;color: rgb(92, 86, 86);font-weight: 300; font-size: 19px;">Tratativa do atendimento:</p>
                       </td>
                   </tr>
                    <tr>
                        <td style="padding-bottom:2%">
                           <p style="font-family: 'Open Sans', sans-serif;color: rgb(92, 86, 86);font-weight: 600; font-size: 19px;">{{ $mensagem['mensagem'] }}</p>
                       </td>
                    </tr>
               </table>
            </td>
        </tr>
        <tr>
            <td>
                <hr>
                <table>
                    <tr>
                        <td width="260" valign="top" style="padding-left: 10rem;" align="center">
                            <a href="http://www.unifametro.edu.br/" target="_blank" rel="noopener noreferrer" style="text-decoration: none; font-family: 'Open Sans', sans-serif;color: rgb(92, 86, 86);">www.unifametro.edu.br</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>


</body>
</html>
