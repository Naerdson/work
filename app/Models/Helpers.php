<?php

namespace App\Models;

/**
 * Class helpers
 * @package App\Helpers
 */
class Helpers
{


    /**
     * @param int $size
     * @return string
     */
    public function generateProtocol(int $size)
    {
        //String com valor possíveis do resultado, os caracteres pode ser adicionado ou retirados conforme sua necessidade
        $basic = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $return= "";

        for($count= 0; $size > $count; $count++){
            //Gera um caracter aleatorio
            $return.= $basic[rand(0, strlen($basic) - 1)];
        }

        return date("dmyHis") . $return;
    }
}
